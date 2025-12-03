<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // data user login
        return view('layouts.profile', compact('user'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'name'   => 'required',
            'email'  => 'required|email',
            'phone'  => 'required',
            'gender' => 'required',
        ]);

        // Update data user
        $user = Auth::user();
        $user->update([
            'name'   => $request->name,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'gender' => $request->gender,
        ]);

        return redirect()->route('home')->with('success', 'Profile updated successfully.');
    }
}
