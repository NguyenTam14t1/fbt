<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function profileUpdate(AdminProfileRequest $request)
    {
        $data = $request->only(['name', 'avatar']);
        $rs = $this->adminService->updateCurrentUser($data);

        if ($rs) {
            return redirect()->route('admin.dashboard')->with([
                'message' => trans('admin/user.message.up_profile_success'),
            ]);
        }

        return redirect()->back()->with([
            'error' => trans('admin/user.message.up_failed'),
        ]);
    }

    public function profile(Request $request)
    {
        $user = auth('admin')->user();
        if ($user) {
            return view('admin.user.profile', compact('user'));
        }

        abort(404);
    }
}
