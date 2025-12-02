<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingHeader;
use App\Models\Reviews;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function show($id)
    {
        $booking = BookingHeader::with('property')->findOrFail($id);

        // Cek apakah booking milik user
        if ($booking->UserID !== auth()->id()) {
            abort(403);
        }

        // Cek hanya boleh review jika status completed
        if ($booking->BookingStatus !== 'completed') {
            return redirect()->route('mybookings')
                ->with('error', 'You cannot review until your stay is completed.');
        }

        return view('layouts.review', compact('booking'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $booking = BookingHeader::findOrFail($id);

        Reviews::create([
            'BookingID' => $booking->id,
            'Rating' => $request->rating,
            'Comment' => $request->comment,
        ]);

        // Update status booking
        $booking->ReviewStatus = 'reviewed';
        $booking->save();

        return redirect()->route('mybookings')
            ->with('success', 'Review submitted successfully!');
    }
}
