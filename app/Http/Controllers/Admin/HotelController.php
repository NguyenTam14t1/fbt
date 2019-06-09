<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\HotelInterface;
use Session;
use Exception;

class HotelController extends Controller
{
    function __construct(HotelInterface $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    public function index()
    {
        $hotels = $this->hotelRepository->getAll();

        return view('admin.hotels.add', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hotels.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'address',
            'phone',
            'rating',
            'website',
            'latitude',
            'longitude',
        ]);

        $response = $this->hotelRepository->store($data);

        if ($response) {
            Session::flash('message', 'Thêm mới khách sạn thành công!');

            return response()->json([
                'status' => true,
            ]);
        }

        Session::flash('error', 'Thêm mới khách sạn thất bại!');

        return response()->json([
            'status' => false,
        ]);
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
        $hotel = $this->hotelRepository->findOrFail($id);

        if (!$hotel) {
            return redirect()->route('admin.hotel.index')->with('error', 'Không tìm thấy khách sạn!');
        }

        return view('admin.hotels.edit', compact('hotel'));
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
        $data = $request->only(['name', 'address', 'phone']);

        $result = $this->hotelRepository->update($data, $id);

        if ($result) {
            return redirect()->route('admin.hotel.index')->with('message', 'Cập nhật khách sạn thành công!');
        }

        Session::flash('error', 'Cập nhật khách sạn thất bại!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->hotelRepository->delete($id);

        if ($response) {
            return redirect()->route('admin.hotel.index')->with('message', 'Xóa khách sạn thành công!');
        }

        return redirect()->route('admin.hotel.index')->with('error', 'Xóa khách sạn thất bại');
    }
}
