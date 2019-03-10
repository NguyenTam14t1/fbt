<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BookingInterface;
use App\Repositories\Contracts\UserInterface;
use App\Models\Booking;
use Exception;
use Carbon\Carbon;
use Auth;
use App\Traits\ProcessOnClient;
use App\Http\Requests\UpdateBookingRequest;
use Session;

class ManagerController extends Controller
{
    use ProcessOnClient;

    protected $bookingRepository;
    protected $userRepository;

    public function __construct(
        BookingInterface $bookingRepository,
        UserInterface $userRepository
    ) {
        $this->bookingRepository = $bookingRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($userId, Request $request)
    {
        try {
            if (Auth::user()->id != $userId) {
                throw new Exception('404');
            }

            $this->updateBookingByTime($this->bookingRepository);
            $booking = $this->bookingRepository->getById($request->booking);

            if ($booking->user->id != $userId) {
                throw new Exception('404');
            }

            if ($booking->status != config('setting.booking_wait_confirm')) {
                return redirect()->back();
            }

            $data = $request->only([
                'first_name',
                'last_name',
                'address',
                'phone',
                'email',
                'identity_card',
                'requiments',
            ]);

            $data['tour_id'] = $booking->tour->id;
            $data['number_of_people'] = $booking->number_of_people;
            $data['number_of_children'] = $booking->number_of_children;
            $data['status'] = $booking->status;
            $data['paymented'] = $booking->paymented;
            $data['debt'] = $booking->debt;
            $data['times_payment'] = $booking->times_payment;
            $data['confirm_code'] = $booking->confirm_code;
            $data['tour'] = $booking->tour;

            $this->sendingMail($data, Auth::user()->email);
            $message = trans('lang.send_mail_success_1') . str_limit(Auth::user()->email, 6, '******') . trans('lang.send_mail_success_2');
            $request->session()->flash('msg_success', $message);

            return redirect()->back();
        } catch (Exception $e) {
            if($e->getMessage() != '404') {
                $request->session()->flash('msg_error', trans('lang.send_mail_error'));

                return redirect()->back();
            }

            return redirect()->route('404');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($userId, $status)
    {
        try {
            if (Auth::user()->id != $userId) {
                throw new Exception('404');
            }

            $this->updateBookingByTime($this->bookingRepository);
            $data['user'] = $this->userRepository->getById($userId);
            $data['bookings'] = $this->userRepository->getBookingsPaginate($data['user'], $status, config('setting.paginate_default_val'));
            $data['status'] = $status;
            
            switch ($status) {
                case config('setting.booking_cancel'):
                    $data['title'] = trans('lang.tour_cancel');
                    break;
                case config('setting.booking_wait_confirm'):
                    $data['title'] = trans('lang.tour_wait_confirm');
                    break;
                case config('setting.booking_confirmed'):
                    $data['title'] = trans('lang.tour_confirmed');
                    break;
                case config('setting.booking_paymented'):
                    $data['title'] = trans('lang.tour_paymented');
                    break;
                case config('setting.booking_finished'):
                    $data['title'] = trans('lang.tour_finished');
                    break;
                default:
                    $data['title'] = trans('lang.all_tour');
                    break;
            }

            return view('bookingtour.list-booking', compact('data'));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($userId, $id)
    {
        try {
            if (Auth::user()->id != $userId) {
                throw new Exception();
            }

            $this->updateBookingByTime($this->bookingRepository);
            $data['user'] = $this->userRepository->getById($userId);
            $booking = $this->bookingRepository->getById($id);

            if ($booking->user->id != $userId) {
                throw new Exception();
            }

            $data['edit'] = '';
            $data['update'] = true;
            $time_start_tour = new Carbon($booking->tour->time_start);
            $deadline = $time_start_tour->subMinutes(config('setting.deadline_booking_minutes'));            
            $time_now = Carbon::now();
            
            if ($deadline->lte($time_now)) {
                $data['update'] = false;
            }

            switch ($booking->status) {
                case config('setting.booking_cancel'):
                    $data['status_message'] = trans('lang.tour_cancel');
                    $data['edit'] = 'readonly';
                    $data['update'] = false;
                    break;
                case config('setting.booking_wait_confirm'):
                    $data['step-2'] = 'active';
                    $data['step-3'] = 'disabled';
                    $data['update'] = false;
                    break;
                case config('setting.booking_confirmed'):
                    $data['step-2'] = 'complete';
                    $data['step-3'] = 'disabled';
                    break;
                case config('setting.booking_paymented'):
                    $data['step-2'] = 'complete';
                    $data['step-3'] = 'complete';
                    break;
                case config('setting.booking_finished'):
                    $data['status_message'] = trans('lang.tour_finished');
                    $data['edit'] = 'readonly';
                    break;
                default:
                    throw new Exception();
                    break;
            }

            return view('bookingtour.view-booking', compact('booking', 'data'));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($userId, UpdateBookingRequest $request, $id)
    {
        try {
            if (Auth::user()->id != $userId) {
                throw new Exception();
            }

            $this->updateBookingByTime($this->bookingRepository);
            $booking = $this->bookingRepository->getById($id);

            if ($booking->user->id != $userId) {
                throw new Exception();
            }

            $data = $request->only([
                'first_name',
                'last_name',
                'address',
                'phone',
                'email',
                'identity_card',
                'requiments',
            ]);

            $this->bookingRepository->update($booking->id, $data);
            $request->session()->flash('msg_success', trans('lang.update_access'));

            return redirect()->back();
        } catch (Exception $e) {
            if($e->getMessage() != '404') {
                $request->session()->flash('msg_error', trans('lang.update_error'));

                return redirect()->back();
            }

            return redirect()->route('404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId, $id)
    {
         try {
            if (Auth::user()->id != $userId) {
                throw new Exception('404');
            }

            $this->updateBookingByTime($this->bookingRepository);
            $booking = $this->bookingRepository->getById($id);

            if ($booking->user->id != $userId) {
                throw new Exception('404');
            }

            $data['status'] = config('setting.booking_cancel');
            $this->bookingRepository->update($booking->id, $data);
            Session::flash('msg_success', trans('lang.cancel_success'));

            return redirect()->back();
        } catch (Exception $e) {
            if($e->getMessage() != '404') {
                Session::flash('msg_error', trans('lang.cancel_error'));

                return redirect()->back();
            }

            return redirect()->route('404');
        }
    }

    public function bookingShow(Request $request)
    {
        $this->updateBookingByTime($this->bookingRepository);
        $data['user'] = $this->userRepository->getById($request->user_id);
        $data['bookings'] = $this->userRepository->getBookingsPaginate($data['user'], $request->status, config('setting.paginate_default_val'));

        return view('bookingtour.ajax.bookings-show', compact('data'));
    }
}
