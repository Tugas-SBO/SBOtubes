<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create(Hotel $hotel)
    {
        return view('booking.create', compact('hotel'));
    }

    public function store(Request $request, Hotel $hotel)
    {
        $request->validate([
            'check_in'  => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests'    => 'required|integer|min:1|max:10',
        ]);

        $nights = \Carbon\Carbon::parse($request->check_in)
            ->diffInDays($request->check_out);

        $total = $nights * $hotel->price_per_night;

        Booking::create([
            'user_id'     => Auth::id(),
            'hotel_id'    => $hotel->id,
            'check_in'    => $request->check_in,
            'check_out'   => $request->check_out,
            'guests'      => $request->guests,
            'total_price' => $total,
            'status'      => 'pending',
        ]);

        return redirect()->route('booking.success')
            ->with('success', 'Booking berhasil!');
    }

    public function success()
    {
        return view('booking.success');
    }
}
