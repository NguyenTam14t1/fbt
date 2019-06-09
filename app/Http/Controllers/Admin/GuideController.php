<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\GuideInterface;

class GuideController extends Controller
{

    function __construct(GuideInterface $guideRepository)
    {
        $this->guideRepository = $guideRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guides = $this->guideRepository->getAll();

        return view('admin.guides.index', compact('guides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.guides.add');
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
            'mail',
            'category_id',
        ]);

        $response = $this->guideRepository->store($data);
        if ($response) {
            return redirect()->route('admin.guide.index')->with('mesage', 'Thêm mới hướng dẫn viên thành công!');
        }

        Session::flash('error', 'Thêm mới hướng dẫn viên thất bại!');

        return redirect()->back();
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
        $guide = $this->guideRepository->findOrFail($id);

        if (!$guide) {
            return redirect()->route('admin.guide.index')->with('error', 'Không tìm thấy hưóng dẫn viên!');
        }

        return view('admin.guides.edit', compact('guide'));
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
        $data = $request->only(['name', 'address', 'phone', 'category_id']);

        $result = $this->guideRepository->update($data, $id);

        if ($result) {
            return redirect()->route('admin.guide.index')->with('mesage', 'Cập nhật hướng dẫn viên thành công!');
        }

        Session::flash('error', 'Cập nhật hướng dẫn viên thất bại!');

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
        $response = $this->guideRepository->delete($id);

        if ($response) {
            return redirect()->route('admin.guide.index')->with('message', 'Xóa hướng dẫn viên thành công!');
        }

        return redirect()->route('admin.guide.index')->with('error', 'Xóa hướng dẫn viên thành công');
    }
}
