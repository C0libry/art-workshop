<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Booking;

class BookingApproveController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'book_id' => ['required', 'integer'],
        ]);
        $booking = Booking::find($request->book_id);
        $booking->approved = !($booking->approved);
        $booking->update();
        return $booking->approved;
    }
}
