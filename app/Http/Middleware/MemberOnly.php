<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MemberOnly
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please login first.');
        }

        if (Auth::user()->role !== 'member') {
            return redirect('/')->with('error', 'Admins cannot access this page.');
        }

        return $next($request);
    }
}
