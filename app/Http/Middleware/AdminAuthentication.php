<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check())
        {
            $user = Auth::user()->load('group');
            $arrGroupName = [];

            if ($user->group->name == 'admin')
            {
                return $next($request);
            } else {
                Auth::logout();
                return redirect()->route('admin.login');
            }
        } else
            return redirect()->route('admin.login');
    }
}
