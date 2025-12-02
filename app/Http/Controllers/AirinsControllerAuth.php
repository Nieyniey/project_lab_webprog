<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AirinsControllerAuth extends Controller
{
    // Show login page
    public function ShowLogin()
    {
        // Jika sudah login → redirect home
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.login'); 
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
            return redirect()->route('home');
        }

        // Jika salah → kirim error
        return back()->withErrors([
            'login_error' => 'Email or password is incorrect.',
        ])->withInput();

        return back()->withErrors([
            'login_error' => 'Email or password is incorrect.',
        ])->withInput();
    }

    // Logout
    public function Logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showRegister()
    {
        // Kalau sudah login, redirect ke home
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi form
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'gender' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        // Simpan user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'role' => 'member', 
        ]);

        // Redirect ke home dengan success message
        return redirect()->route('login')->with('success', 'Registration successful!');
        }

}
