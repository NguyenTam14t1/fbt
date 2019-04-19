<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserInterface;
use App\Repositories\Contracts\BookingInterface;
use Auth;
use Exception;
use App\Traits\ProcessOnClient;

class UserController extends Controller
{
    protected $userRepository;
    protected $bookingRepository;

    use ProcessOnClient;

    public function __construct(
        UserInterface $userRepository, 
        BookingInterface $bookingRepository
    ) {
        $this->userRepository = $userRepository;
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data['user'] = Auth::user();
            
            if (!$data['user']) {
                throw new Exception();
            }

            $this->updateBookingByTime($this->bookingRepository);

            $data['tour_cancel'] = $this->userRepository->getBookings($data['user'], config('setting.booking_cancel'))->get();
            $data['tour_wait_confirm'] = $this->userRepository->getBookings($data['user'], config('setting.booking_wait_confirm'))->get();
            $data['tour_confirmed'] = $this->userRepository->getBookings($data['user'], config('setting.booking_confirmed'))->get();
            $data['tour_paymented'] = $this->userRepository->getBookings($data['user'], config('setting.booking_paymented'))->get();
            $data['tour_finished'] = $this->userRepository->getBookings($data['user'], config('setting.booking_finished'))->get();
            $data['booking_recent'] = $this->userRepository->getBookingsRecent($data['user'])->get();

            return view('bookingtour.user-dashboard', compact('data'));
        } catch (Exception $e) {
            return redirect()->route('404');
        }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
