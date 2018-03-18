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
        $bookings = $this->bookingRepository->paginate(config('setting.paginate_default_val'));

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
