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

        // Ambil semua booking user + relasi property
        $bookings = BookingHeader::with('property')
            ->where('UserID', $user->UserID)   // <- FIX: user->UserID bukan user->id
            ->orderBy('CheckInDate', 'asc')
            ->get();

        return view('layouts.mybooking', compact('bookings'));
    }

    public function cancel($id)
    {
        $booking = BookingHeader::findOrFail($id);

        // Pastikan hanya pemilik booking yang bisa cancel
        if ($booking->UserID !== Auth::user()->UserID) {
            abort(403, 'Unauthorized');
        }

        // Update status
        $booking->BookingStatus = 'cancelled';
        $booking->save();

        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }
}
