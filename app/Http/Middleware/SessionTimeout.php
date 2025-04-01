<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionTimeout
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = Session::get('last_activity', time());
            $timeout = config('session.lifetime') * 60; // Convert minutes to seconds

            if (time() - $lastActivity > $timeout) {
                Auth::logout();
                Session::flush();
                return redirect()->route('login')->with('message', 'Your session has expired.');
            }

            Session::put('last_activity', time());
        }

        return $next($request);
    }
}