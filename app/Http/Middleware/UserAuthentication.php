<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserAuthentication
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

            if ($user->group->name == 'user')
            {
                return $next($request);
            } else {
                Auth::logout();
                // dd(1,Auth::logout());
                // return redirect()->route('home');
            }
        } else
        // dd(2);
            return redirect()->route('home');
    }
}
