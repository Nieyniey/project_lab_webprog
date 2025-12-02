@extends('layouts.app')

@section('content')
<div style="padding:40px; max-width:700px; margin:auto;">

    <h2 style="margin-bottom:25px;">Write a Review</h2>

    <div style="
        background:white; padding:20px; border-radius:16px;
        box-shadow:0 2px 10px rgba(0,0,0,0.08); margin-bottom:25px;">
        <h4>{{ $booking->property->Title ?? 'Unknown Property' }}</h4>
        <p>Check-out: {{ $booking->CheckOutDate }}</p>
    </div>

    <form method="POST" action="{{ route('review.submit', $booking->id) }}"
          style="background:white; padding:20px; border-radius:16px;
          box-shadow:0 2px 10px rgba(0,0,0,0.08);">
        @csrf

        <label>Rating</label>
        <select name="rating" style="padding:8px; border-radius:8px;">
            <option value="">Select rating</option>
            @for ($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}">{{ $i }} ★</option>
            @endfor
        </select>

        <br><br>

        <label>Comment</label>
        <textarea name="comment" rows="4"
                  style="width:100%; border-radius:8px; padding:10px;"></textarea>

        <br><br>

        <button type="submit"
                style="width:100%; padding:10px; background:#ff4d8d;
                       color:white; border:none; border-radius:10px;">
            Submit Review
        </button>
    </form>

</div>
@endsection
