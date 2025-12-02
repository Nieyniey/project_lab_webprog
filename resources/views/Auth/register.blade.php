@extends('layouts.app')

@section('content')

<style>
    .register-container {
        width: 420px;
        margin: 60px auto;
        background: white;
        padding: 40px;
        border-radius: 18px;
        box-shadow: 0 4px 25px rgba(0,0,0,0.1);
        text-align: center;
        font-family: 'Inter', sans-serif;
    }

    .register-container label {
        display: block;
        text-align: left;
        margin-top: 12px;
        font-weight: 600;
        color: #333;
    }

    .register-container input,
    .register-container select {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ddd;
        margin-top: 6px;
        background: #fafafa;
    }

    .register-container input:focus,
    .register-container select:focus {
        border-color: #ff4d8d;
        outline: none;
        box-shadow: 0 0 4px rgba(255, 77, 141, 0.4);
    }

    .register-logo {
        width: 60px;
        margin-bottom: 10px;
    }

    .register-title {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .error-text {
        color: #ff4d8d;
        font-size: 14px;
        margin-bottom: 15px;
    }

    .register-button {
        margin-top: 22px;
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: none;
        background: #ff4d8d;
        color: white;
        font-weight: bold;
        font-size: 15px;
        cursor: pointer;
        transition: 0.25s;
    }

    .register-button:hover {
        background: #ff2d78;
    }

    .register-container p {
        margin-top: 18px;
        font-size: 14px;
    }

    .register-container a {
        color: #ff4d8d;
        font-weight: 600;
        text-decoration: none;
    }
</style>

<div class="register-container">

    {{-- LOGO --}}
    <img src="/logo.jpg" alt="AirInS" class="register-logo">

    {{-- TITLE --}}
    <h2 class="register-title">Create your account</h2>

    {{-- ERROR MESSAGE --}}
    @if ($errors->any())
        <div class="error-text">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="/register" method="POST">
        @csrf

        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}">

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">

        <label>Phone</label>
        <input type="text" name="phone" value="{{ old('phone') }}">

        <label>Gender</label>
        <select name="gender">
            <option value="">Select Gender</option>
            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
        </select>

        <label>Password</label>
        <input type="password" name="password">

        <label>Confirm Password</label>
        <input type="password" name="password_confirmation">

        <button type="submit" class="register-button">Register</button>

        <p>Already have an account? <a href="/login">Login</a></p>
    </form>

</div>

@endsection
