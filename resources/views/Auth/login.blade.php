@extends('layouts.app')

@section('content')

<div style="display:flex; justify-content:center; align-items:center; height:80vh;">
    <div style="width:380px; background:white; padding:30px; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,0.1); text-align:center;">
        
        <img src="/logo.jpg" alt="AirinS" width="80" class="mb-3">

        <h3 class="mb-4">Login to your account</h3>

        {{-- Error message --}}
        @if ($errors->has('login_error'))
            <div style="color:red; font-size:14px; margin-bottom:10px;">
                {{ $errors->first('login_error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div style="text-align:left; margin-bottom:10px;">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required style="width:100%; padding:10px; border-radius:6px; border:1px solid #ccc;">
            </div>

            <div style="text-align:left; margin-bottom:10px;">
                <label>Password</label>
                <input type="password" name="password" required style="width:100%; padding:10px; border-radius:6px; border:1px solid #ccc;">
            </div>

            <div style="text-align:left; margin: 5px 0 15px 0;">
                <input type="checkbox" name="remember">
                <label>Remember Me</label>
            </div>

            <button type="submit" style="width:100%; padding:10px; background:#ff4d8d; color:white; border:none; border-radius:8px;">
                Login
            </button>
        </form>

        <p style="margin-top:15px;">
            Don’t have an account?
            <a href="{{ route('register') }}" style="color:#ff4d8d;">Register</a>
        </p>
    </div>
</div>

@endsection
