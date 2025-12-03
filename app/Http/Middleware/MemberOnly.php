<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MemberOnly
{
    public function handle($request, Closure $next)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please login first.');
        }

        // Hanya role member yang boleh akses
        if (Auth::user()->role !== 'member') {
            return redirect('/')->with('error', 'Admins cannot access the profile page.');
        }

        return $next($request);
    }
}
