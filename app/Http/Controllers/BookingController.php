<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Properties;
use App\Models\BookingHeader;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function book(Request $request, $id)
    {
        $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1'
        ]);

        $properties = Properties::findOrFail($id);

        $alreadyBooked = BookingHeader::whereHas('details', function ($q) use ($id) {
            $q->where('PropertyID', $id);
        })
        ->where(function ($date) use ($request) {
            $date->whereBetween('CheckInDate', [$request->check_in, $request->check_out])
                ->orWhereBetween('CheckOutDate', [$request->check_in, $request->check_out])
                ->orWhere(function ($overlap) use ($request) {
                    $overlap->where('CheckInDate', '<=', $request->check_in)
                            ->where('CheckOutDate', '>=', $request->check_out);
                });
        })
        ->exists();

        if ($alreadyBooked) {
            return back()->with('error', 'The property is unavailable for the selected dates. Please select another range.');
        }

        BookingHeader::create([
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
        $bookings = BookingHeader::with('property')
            ->where('user_id', Auth::id())
            ->orderBy('check_in', 'asc')
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
