<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BookingHeader;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $bookings = BookingHeader::with('property')
            ->where('UserID', $user->id)
            ->orderBy('CheckInDate', 'asc')
            ->get();

        return view('layouts.mybooking', compact('bookings'));
    }

    public function cancel($id)
    {
        $booking = BookingHeader::findOrFail($id);

        if ($booking->UserID != Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $booking->BookingStatus = 'cancelled';
        $booking->save();

        return back()->with('success', 'Booking cancelled.');
    }
}
