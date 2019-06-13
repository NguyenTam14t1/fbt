<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ManaUserInterface;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    function __construct(ManaUserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getAll();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->only([
            'name',
            'address',
            'phone',
            'email',
        ]);

        $response = $this->userRepository->store($data);
        if ($response) {
            return redirect()->route('admin.user.index')->with('message', 'Thêm mới người dùng thành công!');
        }

        Session::flash('error', 'Thêm mới người dùng thất bại!');

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

    public function destroy($id)
    {
        $response = $this->userRepository->delete($id);

        if ($response) {
            return redirect()->route('admin.user.index')->with('message', 'Xóa người dùng thành công!');
        }

        return redirect()->route('admin.user.index')->with('error', 'Xóa người dùng thành công');
    }
}
