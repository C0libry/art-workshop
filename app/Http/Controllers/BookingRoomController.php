<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\BookingRoomRequest;
use App\Models\Booking;
use Illuminate\Support\Carbon;

class BookingRoomController extends Controller
{
    public function create(BookingRoomRequest $request)
    {
        if (strlen($request->booking_start) == 1)
            $booking_start = '0' . $request->booking_start;

        if (strlen($request->booking_end) == 1)
            $booking_end = '0' . $request->booking_end;

        $start = Carbon::createFromFormat('m/d/Y H', $request->booking_date . ' ' . $booking_start);
        $end = Carbon::createFromFormat('m/d/Y H', $request->booking_date . ' ' . $request->booking_end);
        $booking = new Booking();
        $booking->booking_start = $start;
        $booking->booking_end = $end;
        $booking->room_id = $request->room_id;
        $booking->fullname = $request->fullname;
        $booking->age = $request->age;
        $booking->institute = $request->institute;
        $booking->course = $request->course;
        $booking->phone = $request->phone;
        $booking->social_network = $request->social_network;
        $booking->save();
        return 'ok';
    }
}
