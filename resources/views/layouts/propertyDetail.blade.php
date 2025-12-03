@extends('layouts.app')

@section('content')

<style>
    .text-muted-custom { color: #555; }

    .title-bold { 
        font-weight: 750; 
        font-size: 26px; 
    }

    .reserve-label { 
        font-size: 15px; 
        font-weight: 600; 
    }

    .guest-counter {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .guest-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: none;
        background: #ddd;
        font-weight: bold;
    }
    .guest-number {
        width: 40px;
        text-align: center;
        font-size: 16px;
        font-weight: 600;
    }

    .no-border-input {
        border: none;
        border-bottom: 1px solid #ccc;
        border-radius: 0;
        box-shadow: none !important;
    }

    .property-price {
        color: #ff4d8d;
        font-weight: 600;
        font-size: 22px;
    }

    .per-night {
        color: #555;
        font-weight: 400;
        font-size: 22px;
    }

    .review-card {
        max-width: 600px;
    }

    .date-input {
        border: 1px solid transparent !important;
        background: #f8f8f8;
        padding: 10px;
        border-radius: 8px;
        width: 100%;
        outline: none;
    }

    .guest-counter {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 8px;
    }

    .counter-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 1px solid #bbb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        cursor: pointer;
        user-select: none;
        background: white;
    }

    .counter-btn:hover {
        background: #f0f0f0;
    }

    #guestNumber {
        font-weight: 600;
        width: 40px;
        text-align: center;
        font-size: 16px;
    }
</style>

<div class="container mt-4">

    {{-- MESSAGES --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <div class="row">

        {{-- LEFT IMAGE --}}
        <div class="col-md-6">
            <img src="{{ asset('properties/' . $properties->Photos) }}" 
                 style="width:100%; border-radius:16px; box-shadow:0 4px 15px rgba(0,0,0,0.1);">
        </div>

        {{-- RIGHT DETAILS --}}
        <div class="col-md-6">

            {{-- TITLE --}}
            <h2 class="title-bold">{{ $properties->Title }}</h2>

            {{-- LOCATION + CATEGORY --}}
            <p class="text-muted-custom">
                {{ $properties->Location }} • 
                Category: {{ $properties->propertycategory->PropertyCategoryName ?? 'N/A' }}
            </p>

            {{-- PRICE --}}
            <div class="property-price">Rp {{ number_format($properties->price, 0, ',', '.') }}
                 <span class="per-night"> / night</span>
            </div>

            {{-- HOST --}}
            <p class="text-muted-custom">
                Hosted by 
                <strong style="font-weight:700;">
                    {{ $properties->user->Role == 'admin' ? 'Admin User' : $properties->user->Name }}
                </strong>
            </p>

            {{-- DESCRIPTION --}}
            <p class="text-muted-custom">{{ $properties->Description }}</p>


            {{-- RESERVE BOX --}}
            <div class="card p-4 mt-3 shadow-sm" style="border-radius: 16px;">

                <h4 style="font-weight: 600; font-size: 18px;">Reserve</h4>

                @guest
                {{-- Guest: show form but send to login --}}
                <form action="{{ route('login') }}">
                    <label class="mt-2">Check-in</label>
                    <input type="date" class="date-input" disabled>

                    <label class="mt-3">Check-out</label>
                    <input type="date" class="date-input" disabled>

                    <label class="mt-3">Guests</label>

                    <div class="guest-counter">
                        <div class="counter-btn" onclick="changeGuest(-1)">–</div>

                        <span id="guestNumber">1</span>
                        <input type="hidden" name="guests" id="guestInput" value="1">

                        <div class="counter-btn" onclick="changeGuest(1)">+</div>
                    </div>

                    <button class="btn btn-danger w-100 mt-4">
                        Login to Reserve
                    </button>
                </form>

            @else
                {{-- Logged-in user: submit booking --}}
                <form action="{{ route('property.book', $properties->id) }}" method="POST">
                    @csrf

                    <label class="mt-2">Check-in</label>
                    <input type="date" name="check_in" class="date-input" required>

                    <label class="mt-3">Check-out</label>
                    <input type="date" name="check_out" class="date-input" required>

                    <label class="mt-3">Guests</label>

                    <div class="guest-counter">
                        <div class="counter-btn" onclick="changeGuest(-1)">–</div>

                        <span id="guestNumber">1</span>
                        <input type="hidden" name="guests" id="guestInput" value="1">

                        <div class="counter-btn" onclick="changeGuest(1)">+</div>
                    </div>

                    <button class="btn btn-danger w-100 mt-4">
                        Reserve
                    </button>
                </form>

            @endguest

            </div>

            <script>
                let guestCount = 1;

                function changeGuest(num) {
                    guestCount += num;

                    if (guestCount < 1) guestCount = 1;

                    document.getElementById('guestNumber').innerText = guestCount;
                    document.getElementById('guestInput').value = guestCount;
                }
            </script>

            </div>

        </div>
    </div>

    {{-- REVIEWS SECTION --}}
    <h3 class="mt-5" style="font-weight:700;">Reviews</h3>

    @forelse ($properties->reviews as $review)
        <div class="card p-3 mt-3 review-card">
            <strong>{{ $review->bookingheader->user->Name }}</strong>
            <p>{{ $review->Comment }}</p>
            <small class="text-muted-custom">
                Reviewed on {{ $review->created_at->format('F d, Y') }}
            </small>
        </div>
    @empty
        <p class="text-muted-custom mt-2">No reviews yet.</p>
    @endforelse
    
</div>

@endsection
