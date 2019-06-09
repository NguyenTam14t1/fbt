<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BookingInterface;
use App\Traits\ProcessOnClient;
use Maatwebsite\Excel\Facades\Excel;

class BookingController extends Controller
{
    use ProcessOnClient;

    protected $bookingRepository;

    public function __construct(BookingInterface $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->updateBookingByTime($this->bookingRepository);
        $bookings = $this->bookingRepository->getAll();

        return view('admin.bookings.index', compact('bookings'));
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
        // $booking = $this->bookingRepository->findOrFail($id);

        // return view('admin.bookings.detail', compact(['booking']));
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
        $data = $request->only(['status_payment']);
        $data['status_payment'] = $data['status_payment'] === 'true' ? true : false;

        $data['status'] = $data['status_payment'] ? config('setting.booking_finished')
                                                : config('setting.booking_wait_confirm');

        $result = $this->bookingRepository->update($id, $data);

        if ($result) {
            return redirect()->route('admin.booking.index')->with('message', 'Thay đổi trạng thái thanh toán thành công!');
        }

        return redirect()->route('admin.booking.index')->with('error', 'Có lỗi xảy ra!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->bookingRepository->delete($id);

        if ($response) {
            return redirect()->route('admin.booking.index')->with('message', $response);
        }

        return redirect()->route('admin.booking.index')->with('error', 'Có lỗi xảy ra!');
    }

    public function exportBooking(Request $request)
    {
        $type = $request->type;
        $this->updateBookingByTime($this->bookingRepository);
        $data = $this->bookingRepository->getAll()->toArray();

        return Excel::create('Travel_Tour_Bookings', function ($excel) use ($data) {
            $excel->sheet('My_Sheet', function($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}
