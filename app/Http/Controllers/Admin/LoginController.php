<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use DB;
use Exception;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check())
        {
            $user = Auth::user()->load('group');
            $arrGroupName = [];

            if ($user->group->name == 'admin')
            {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return view('admin.pages.login');
            }
        } else
            return view('admin.pages.login');
    }

    public function store(Request $request)
    {
        $data = $request->only(['email', 'password']);

        $groupName = DB::table('users')->select('groups.name')
                                        ->join('groups', 'users.group_id', '=', 'groups.id')
                                        ->where('email', $data['email'])
                                        ->get()
                                        ->toArray();

        $arrGroupName = [];
        foreach ($groupName as $key => $value) {
            $name = $value->name;
            array_push($arrGroupName, $name);
        }

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']]) && in_array('admin', $arrGroupName)) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('errors', trans('admin/auth.login_faild'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }
}
