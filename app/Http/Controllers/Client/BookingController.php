<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TourInterface;
use Session;
use App\Http\Requests\InfoBookingRequest;
use App\Models\Booking;
use Auth;
use Mail;
use Exception;
use Carbon\Carbon;

class BookingController extends Controller
{
    protected $tourRepository;

    public function __construct(TourInterface $tourRepository)
    {
        $this->tourRepository = $tourRepository;
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
            
            $this->sendingMail($data, 'daikahemvang@gmail.com');
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

    public function sendingMail(array $data, $mailTo) {
        $mData = ['data' => $data];
        
        Mail::send('bookingtour.mail-form', $mData, function($message) use ($mailTo) {
            $message->to($mailTo, 'Guest');
            $message->subject('Booking Tour Request Confirmation');
            $message->from(config('mail.username'),'Travel Tour');
        });
    }

    public function confirmRequest($code)
    {
        $booking = Booking::where('confirm_code', $code);
        if ($booking->count()) {
            $booking = $booking->first();
            
            if ($booking->status != config('setting.booking_wait_confirm')) {
                return redirect()->route('404');
            }

            Session::forget('confirm');
            $data['confirm_code'] = '';
            $time_created = new Carbon($booking->created_at);
            $time_now = Carbon::now();
            $minute_diff = $time_created->diffInMinutes($time_now);
                
            if ($minute_diff > config('setting.deadline_confirm_minutes')) {
                $data['status'] = config('setting.booking_cancel');
                $booking->update($data);

                return redirect()->route('404');
            } else {
                $data['status'] = config('setting.booking_confirmed');
                $booking->update($data);

                return view('bookingtour.booking-2-2', compact('booking'));
            }
        }
        
        return redirect()->route('404');
    }

    public function payment(Request $request)
    {
        $booking = Booking::find($request->booking);
        
        return view('bookingtour.booking-3', compact('booking'));
    }
}
