<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TourInterface;
use App\Repositories\Contracts\BookingInterface;
use Session;
use App\Http\Requests\InfoBookingRequest;
use Auth;
use Exception;
use Carbon\Carbon;
use App\Traits\ProcessOnClient;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

use Stripe\Stripe;
use Stripe\Charge;

class BookingController extends Controller
{
    use ProcessOnClient;

    protected $tourRepository;
    protected $bookingRepository;

    private $apiContext;
    private $mode;
    private $client_id;
    private $secret;

    public function __construct(
        TourInterface $tourRepository,
        BookingInterface $bookingRepository
    ) {
        $this->tourRepository = $tourRepository;
        $this->bookingRepository = $bookingRepository;

        // if(config('paypal.settings.mode') == 'live'){
            // $this->client_id = config('paypal.live_client_id');
            // $this->secret = config('paypal.live_secret');
        // } else {
        //     $this->client_id = config('paypal.client_id');
        //     $this->secret = config('paypal.secret');
        // // }

        // // Set the Paypal API Context/Credentials
        // $this->apiContext = new ApiContext(new OAuthTokenCredential($this->client_id, $this->secret));
        // $this->apiContext->setConfig(config('paypal.settings'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if (!Session::has('adults') || !Session::has('children')) {
            return redirect()->route('client.tour.show', $id);
        }

        $data['tour'] = $this->tourRepository->findOrFail($id);
        $data['adults'] = Session::get('adults');
        $data['children'] = Session::get('children');
        $data['price'] = ($data['adults'] + ($data['children']) / 2) * $data['tour']->price;
        $data['categories'] = $this->getParentCategories($data['tour']);
        $data['term'] = $this->tourRepository->getTerm();
        Session::put('create_first', 'OK');

        return view('bookingtour.booking-1', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, InfoBookingRequest $request)
    {
        try {
            if (!Session::has('adults') || !Session::has('children')) {
                return redirect()->route('client.tour.show', $id);
            }

            $tour = $this->tourRepository->findOrFail($id);
            $data = $request->only([
                'first_name',
                'last_name',
                'address',
                'phone',
                'email',
                'identity_card',
                'requiments',
            ]);

            $data['tour_id'] = $tour->id;
            $data['number_of_people'] = Session::get('adults');
            $data['number_of_children'] = Session::get('children');
            $data['status'] = config('setting.booking_wait_confirm');
            $data['debt'] = ($data['number_of_people'] + ($data['number_of_children']) / 2) * $tour->price;

            $data['count_register'] = $request->num_register;
            $dataGuest = $request->guest;

            $data['listGuest'] = [];
            if  (isset($data['count_register']) && $data['count_register'] > 0) {
                for ($i = 0; $i < $data['count_register']; $i++) {
                    $data['listGuest'][$i] = [
                        'full_name' => $dataGuest['full_name'][$i],
                        'date_born' => $dataGuest['date_born'][$i],
                        'type_guest' => $dataGuest['type_guest'][$i],
                    ];
                }
            }

            Session::forget('adults');
            Session::forget('children');

            if (Session::has('create_first')) {
                $data['confirm_code'] = time() . uniqid(true);
                $this->tourRepository->addNewBookingFromUser(Auth::user()->id, $data, $id);
                Session::put('confirm', $data['confirm_code']);
                Session::forget('create_first');
            }

            if (!Session::has('confirm')) {
                return redirect()->route('client.tour.show', $id);
            }
            $data['confirm_code'] = Session::get('confirm');
            $data['tour'] = $tour;
            $data['categories'] = $this->getParentCategories($data['tour']);

            $this->sendingMail($data, Auth::user()->email);
            $message = trans('lang.send_mail_success_1') . str_limit(Auth::user()->email, 6, '******') . trans('lang.send_mail_success_2');
            Session::flash('send_success', $message);
        } catch (Exception $e) {
            report($e);

            Session::flash('send_error', trans('lang.send_mail_error'));
        }

        return view('bookingtour.booking-2-1', compact('data'));
    }

    public function selectParticipant(Request $request)
    {
        $request->session()->put('adults', $request->adults);
        $request->session()->put('children', $request->children);
    }

    public function confirmRequest($code)
    {
        $this->updatebookingByTime($this->bookingRepository);
        $booking = $this->bookingRepository->getBookingByConfirm($code);

        if ($booking->count()) {
            $booking = $booking->first();

            if ($booking->status != config('setting.booking_wait_confirm')) {
                return redirect()->route('404');
            }

            $categories = $this->getParentCategories($booking->tour);
            Session::forget('confirm');
            $data['confirm_code'] = '';
            $time_created = new Carbon($booking->created_at);
            $time_now = Carbon::now();
            $deadline_confirm = $time_created->addMinutes(config('setting.deadline_confirm_minutes'));

            if ($deadline_confirm->lte($time_now)) {
                $data['status'] = config('setting.booking_cancel');
                $this->bookingRepository->update($booking->id, $data);

                return redirect()->route('404');
            } else {
                $data['status'] = config('setting.booking_confirmed');
                $this->bookingRepository->update($booking->id, $data);

                return view('bookingtour.booking-2-2', compact('booking', 'categories'));
            }
        }

        return redirect()->route('client.user.index');
    }

    public function payment(Request $request)
    {
        $booking = $this->bookingRepository->getById($request->booking);
        $categories = $this->getParentCategories($booking->tour);

        return view('bookingtour.booking-3', compact('booking', 'categories'));
    }

    public function paymentOnline(Request $request)
    {
        // pay with stripe
        try {
            $infoCard['number'] = $request->card_number;
            $infoCard['exp_month'] = $request->month;
            $infoCard['exp_year'] = $request->year;
            $infoCard['cvv'] = $request->cvv;
            $infoCard['description'] = 'Payment online for tour ' . $request->tour_name;
            $amount = $request->tour_debt;
            $tourId = $request->tour_id;
            $bookingId = $request->booking_id;

            try {
                Stripe::setApiKey(env('STRIPE_SECRET'));

                $charge = Charge::create([
                    // 'card' => $card ,
                    'amount' => $amount,
                    'currency' => 'usd',
                    'source' => env('SOURCE_CARD_STRIPE'),
                ]);
            } catch (\Stripe\Error\Card $e) {
                report($e);

                return false;
            }

            $data['status_payment'] = config('setting.status_payment.paid');
            $data['status'] = config('setting.booking_finished');
            if (isset($data['status_payment'])) {
                $this->bookingRepository->update($bookingId, $data);
            }

            return redirect()->route('paymentSuccess', ['booking' => $bookingId, 'tour' => $tourId]);
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }


        //pay with paypal
        // Create a new billing plan
        // $plan = new Plan();
        // $plan->setName('App Name Monthly Billing')
        //   ->setDescription('Monthly Subscription to the App Name')
        //   ->setType('infinite');

        // // Set billing plan definitions
        // $paymentDefinition = new PaymentDefinition();
        // $paymentDefinition->setName('Regular Payments')
        //   ->setType('REGULAR')
        //   ->setFrequency('Month')
        //   ->setFrequencyInterval('1')
        //   ->setCycles('0')
        //   ->setAmount(new Currency(array('value' => 9, 'currency' => 'USD')));

        // // Set merchant preferences
        // $merchantPreferences = new MerchantPreferences();
        // $merchantPreferences->setReturnUrl('https://website.dev/subscribe/paypal/return')
        //   ->setCancelUrl('https://website.dev/subscribe/paypal/return')
        //   ->setAutoBillAmount('yes')
        //   ->setInitialFailAmountAction('CONTINUE')
        //   ->setMaxFailAttempts('0');

        // $plan->setPaymentDefinitions(array($paymentDefinition));
        // $plan->setMerchantPreferences($merchantPreferences);

        // //create the plan
        // try {
        //     // dd($plan, $this->apiContext);
        //     $createdPlan = $plan->create($this->apiContext);

        //     try {
        //         $patch = new Patch();
        //         $value = new PayPalModel('{"state":"ACTIVE"}');
        //         $patch->setOp('replace')
        //           ->setPath('/')
        //           ->setValue($value);
        //         $patchRequest = new PatchRequest();
        //         $patchRequest->addPatch($patch);
        //         $createdPlan->update($patchRequest, $this->apiContext);
        //         $plan = Plan::get($createdPlan->getId(), $this->apiContext);

        //         // Output plan id
        //         echo 'Plan ID:' . $plan->getId();
        //     } catch (PayPal\Exception\PayPalConnectionException $ex) {
        //         report($ex->getData());
        //         echo $ex->getCode();
        //         echo $ex->getData();
        //         die($ex);
        //     } catch (Exception $ex) {
        //         report($ex);
        //         die($ex);
        //     }
        // } catch (PayPal\Exception\PayPalConnectionException $ex) {
        //         report($ex);
        //     echo $ex->getCode();
        //     echo $ex->getData();
        //     die($ex);
        // } catch (Exception $ex) {
        //         report($ex);
        //     die($ex);
        // }

    //     try {


    //     $paypal = new PayPal;

    //     $response = $paypal->purchase([
    //         'amount' => 2500,
    //         'transactionId' => $order->transaction_id,
    //         'currency' => 'USD',
    //         'cancelUrl' => $paypal->getCancelUrl($order),
    //         'returnUrl' => $paypal->getReturnUrl($order),
    //     ]);

    //     return true;

    // } catch (Exception $e) {
    //     report($e);

    //     return false;
    // }

    public function paymentSuccess($bookingId, $tourId)
    {
        $data['tour'] = $this->tourRepository->findOrFail($tourId);
        $data = $this->tourRepository->getRate($tourId, $data);
        $data['reviews'] = $this->tourRepository->getReviews($data['tour']);
        $data['categories'] = $this->getParentCategories($data['tour']);
        $data['note'] = $this->tourRepository->getNote();
        $data['booking'] = $this->bookingRepository->findOrFail($bookingId);

        return view('bookingtour.tour-booking-success', compact(['data']));
    }
}
