@extends('layouts.app')

@section('content')
<div style="padding:40px; max-width:650px; margin:auto;">

    <h2 class="mb-4">My Profile</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div style="background:#d4edda; padding:12px; border-radius:6px; color:#155724; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf

        <label>Name</label>
        <input type="text" name="name" value="{{ $user->name }}"
               style="width:100%; padding:10px; border-radius:6px; border:1px solid #ccc; margin-bottom:15px;">

        <label>Email</label>
        <input type="email" name="email" value="{{ $user->email }}"
               style="width:100%; padding:10px; border-radius:6px; border:1px solid #ccc; margin-bottom:15px;">

        <label>Phone</label>
        <input type="text" name="phone" value="{{ $user->phone }}"
               style="width:100%; padding:10px; border-radius:6px; border:1px solid #ccc; margin-bottom:15px;">

        <label>Gender</label>
        <select name="gender"
                style="width:100%; padding:10px; border-radius:6px; border:1px solid #ccc; margin-bottom:20px;">
            <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
        </select>

        <button type="submit"
                style="padding:10px 20px; background:#ff4d8d; color:white; border:none; border-radius:6px;">
            Update Profile
        </button>
    </form>

</div>
@endsection
