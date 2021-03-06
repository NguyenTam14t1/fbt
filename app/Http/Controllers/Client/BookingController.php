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

class BookingController extends Controller
{
    use ProcessOnClient;

    protected $tourRepository;
    protected $bookingRepository;

    public function __construct(
        TourInterface $tourRepository, 
        BookingInterface $bookingRepository
    ) {
        $this->tourRepository = $tourRepository;
        $this->bookingRepository = $bookingRepository;
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

        $data['tour'] = $this->tourRepository->getById($id);
        $data['adults'] = Session::get('adults');
        $data['children'] = Session::get('children');
        $data['price'] = ($data['adults'] + ($data['children']) / 2) * $data['tour']->price;
        $data['categories'] = $this->getParentCategories($data['tour']);
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

            $tour = $this->tourRepository->getById($id);
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
            $data['paymented'] = config('setting.paymented_default_value');
            $data['debt'] = ($data['number_of_people'] + ($data['number_of_children']) / 2) * $tour->price;
            
            if ($data['debt'] < config('setting.total_cost_small') ) {
                $data['times_payment'] = config('setting.times_payment_small');
            } elseif ($data['debt'] < config('setting.total_cost_medium')) {
                $data['times_payment'] = config('setting.times_payment_medium');
            } else {
                $data['times_payment'] = config('setting.times_payment_big');
            }
            Session::forget('adults');
            Session::forget('children');
            
            if (Session::has('create_first')) {
                $data['confirm_code'] = time() . uniqid(true); 
                $this->tourRepository->addNewBookingFromUser(Auth::user()->id, $data);
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
}
