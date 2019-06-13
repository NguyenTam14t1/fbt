<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ChangePasswordController extends Controller
{
    public function showChangePassword(Request $request)
    {
        $data['user'] = Auth::user();
        return view('bookingtour.changepass', compact('data'));
    }

    public function showChangePasswordAdmin(Request $request)
    {
        return view('admin.changepass');
    }

    public function saveNewPassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $user->password = $request->get('password');

        $user->save();
        if ($user->save()) {
            return redirect()->back()->with('message', 'Cập nhật mật khẩu thành công!');
        }

        Session::flash('error', 'Cập nhật mật khẩu thất bại!');

        return redirect()->back();
    }
}
