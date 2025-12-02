<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AirinsController extends Controller
{
    // Show login page
    public function ShowLogin()
    {
        // Jika sudah login → redirect home
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('layouts.login'); // memanggil file resources/views/login.blade.php
    }

    // Handle login
    public function Login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        // Attempt login
        if (Auth::attempt($credentials, $remember)) {

            // Jika "Remember Me" dicentang → buat cookie 2 jam
            if ($remember) {
                Cookie::queue(Cookie::make('remember_token', Auth::user()->id, 120));
                // 120 menit = 2 jam
            }

            return redirect()->route('layouts.homeMember');
        }

        // Jika salah → kirim error
        return back()->withErrors([
            'login_error' => 'Email or password is incorrect.',
        ])->withInput();
    }

    // Logout
    public function Logout()
    {
        Auth::logout();
        Cookie::queue(Cookie::forget('remember_token'));

        return redirect()->route('layouts.login');
    }

    public function EditProperty(){}

    public function MyBooking(){}

    public function Profile(){}

    public function Register(){}

    public function Review(){}
}
