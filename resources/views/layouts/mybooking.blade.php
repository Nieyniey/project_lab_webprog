@extends('layouts.app')

@section('content')
<div style="padding:40px; max-width:1100px; margin:auto;">

    <h2 style="margin-bottom:25px;">My Bookings</h2>

    @if ($bookings->count() == 0)
        <p>You have no bookings yet.</p>
    @endif

    @foreach ($bookings as $booking)
    <div style="
        display:flex;
        background:white;
        padding:20px;
        border-radius:16px;
        box-shadow:0 2px 10px rgba(0,0,0,0.1);
        margin-bottom:25px;
    ">

        {{-- Thumbnail --}}
        @if ($booking->property)
            <a href="{{ route('property.detail', ['id' => $booking->property->id]) }}">
                <img src="{{ asset('properties/' . $booking->property->Photos) }}"
                     style="width:260px; height:160px; object-fit:cover; border-radius:12px;">
            </a>
        @else
            <div style="
                width:260px; height:160px;
                border-radius:12px; background:#eee;
                display:flex; align-items:center; justify-content:center;">
                <span>No image</span>
            </div>
        @endif

        {{-- Content --}}
        <div style="margin-left:25px; width:100%;">

            <h4>{{ $booking->property->Title ?? 'Unknown Property' }}</h4>
            <p>{{ $booking->property->Location ?? '-' }}</p>

            <p>
                Check-in: {{ $booking->CheckInDate }} <br>
                Check-out: {{ $booking->CheckOutDate }}
            </p>

            <h5 style="color:#ff4d8d;">
                Rp {{ number_format($booking->TotalPrice, 0, ',', '.') }}
            </h5>

            {{-- Status --}}
            @if ($booking->BookingStatus == 'completed')
                <span style="color:green;">Booking completed</span>

                {{-- BUTTON REVIEW YANG BENAR --}}
                @if ($booking->ReviewStatus == 'not_reviewed')
                    <a href="{{ route('review.page', $booking->id) }}"
                        style="float:right;
                            background:#ff4d8d;
                            color:white;
                            padding:8px 14px;
                            border-radius:8px;">
                        Leave a Review
                    </a>
                @endif

            @elseif ($booking->BookingStatus == 'upcoming')
                <form action="{{ route('cancel.booking', $booking->id) }}"
                      method="POST" style="float:right;">
                    @csrf
                    <button type="submit"
                        onclick="return confirm('Cancel this booking?')"
                        style="
                            background:#ff4d8d;
                            color:white;
                            padding:8px 14px;
                            border-radius:8px;
                            border:none;">
                        Cancel Booking
                    </button>
                </form>

            @elseif ($booking->BookingStatus == 'cancelled')
                <span style="color:red;">Cancelled</span>
            @endif

        </div>

    </div>
    @endforeach

</div>
@endsection
