<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
//use Carbon\Carbon;

class CheckUserBanned
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_blocked) {
            Auth::logout();

            $message = '您的帳號已被停權，請聯絡客服!';

            return redirect()->route('login')->with('danger', $message);
        }

        return $next($request);
    }
}
