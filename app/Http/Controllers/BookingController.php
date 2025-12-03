<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Properties;
use App\Models\BookingHeader;
use App\Models\BookingDetail;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function book(Request $request, $id)
    {
        $today = now()->startOfDay();
        $property = Properties::findOrFail($id);

        if ($property->IsAvailable == 0) {
            return back()->with('error', 'The property is currently unavailable. Please select another property.');
        }

        $checkIn  = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $nights   = $checkOut->diffInDays($checkIn);

        if ($checkIn->lt($today)) {
            return back()->with('error', 'The property is currently unavailable. Please select another dates range.');
        }

        if ($checkOut->lt($today)) {
            return back()->with('error', 'The property is currently unavailable. Please select another dates range.');
        }

        if ($checkOut->lte($checkIn)) {
            return back()->with('error', 'The property is currently unavailable. Please select another dates range.');
        }

        $detail = BookingDetail::where('PropertyID', $id)->first();
        $pricePerNight = $detail->Price;
        $total = $nights * $pricePerNight;

        if (!$detail) {
            return back()->with('error', 'Booking details not found.');
        }

        if ($request->guests > $detail->GuestCount) {
            return back()->with('error', 'The property is currently unavailable for that many guests. Please select another guests range.');
        }

        BookingHeader::create([
            'UserID'       => auth()->id(),
            'PropertyID'   => $id,
            'CheckInDate'  => $request->check_in,
            'CheckOutDate' => $request->check_out,
            'BookingStatus'=> 'pending',
            'BookingDate'  => now(), 
            'ReviewStatus'  => 'not_reviewed',
            'TotalPrice'   => $total,
        ]);


        return redirect()->route('mybookings')->with('success', 'Booking created successfully!');
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
