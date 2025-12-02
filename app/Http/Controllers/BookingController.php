<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BookingHeader;

class BookingController extends Controller
{
    public function book(Request $request, $id)
    {
        $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1'
        ]);

        $property = Properties::findOrFail($id);

        $alreadyBooked = Booking::where('property_id', $id)
            ->where(function ($q) use ($request) {
                $q->whereBetween('check_in', [$request->check_in, $request->check_out])
                  ->orWhereBetween('check_out', [$request->check_in, $request->check_out]);
            })
            ->exists();

        if ($alreadyBooked) {
            return back()->with('error', 'The property is unavailable for the selected dates. Please select another range.');
        }

        Booking::create([
            'user_id' => auth()->id(),
            'property_id' => $id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'guests' => $request->guests
        ]);

        return back()->with('success', 'Booking request submitted successfully!');
    }

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
