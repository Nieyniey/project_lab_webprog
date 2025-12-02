@extends('layouts.app')

@section('content')

<div class="container mt-4">

    {{-- Error or Success message --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <div class="row">

        {{-- LEFT: Property Image --}}
        <div class="col-md-7">
            <img src="{{ asset('properties/' . $property->picture) }}" 
                 style="width:100%; border-radius:16px;">
        </div>

        {{-- RIGHT: Details --}}
        <div class="col-md-5">

            <h2>{{ $property->title }}</h2>

            <p>
                {{ $property->location }} • 
                Category: {{ $property->propertycategory->CategoryName ?? 'N/A' }}
            </p>

            <h3 style="color:#e63946">
                Rp {{ number_format($property->price, 0, ',', '.') }}
                <span style="color:#666; font-size:18px;">/ night</span>
            </h3>

            <p>Hosted by <strong>{{ $property->user->name }}</strong></p>

            <p style="color:#444">{{ $property->description }}</p>


            {{-- RESERVE BOX --}}
            <div class="card p-4 mt-3">

                <h4>Reserve</h4>

                @guest
                    {{-- Guest: show login button --}}
                    <a href="{{ route('login') }}" class="btn btn-danger w-100 mt-3">
                        Login to Reserve
                    </a>
                @else
                    {{-- Logged-in user --}}
                    <form action="{{ route('property.book', $property->id) }}" method="POST">
                        @csrf

                        <label>Check-in</label>
                        <input type="date" name="check_in" class="form-control" required>

                        <label class="mt-2">Check-out</label>
                        <input type="date" name="check_out" class="form-control" required>

                        <label class="mt-2">Guests</label>
                        <input type="number" name="guests" class="form-control" min="1" value="1" required>

                        <button class="btn btn-danger w-100 mt-3">
                            Reserve
                        </button>
                    </form>
                @endguest

            </div>

        </div>
    </div>


    {{-- REVIEWS --}}
    <h3 class="mt-5">Reviews</h3>

    <div class="card p-3 mt-3">
        <strong>John Doe</strong>
        <p>Perfect cabin for a peaceful getaway. Stunning mountain views!</p>
        <small>Reviewed on May 24, 2025</small>
    </div>

</div>

@endsection
