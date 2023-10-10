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
        $start = Carbon::createFromFormat('Y-m-d H:i:s.u', '2019-02-01 03:45:27.612584');
        $end = Carbon::createFromFormat('Y-m-d H:i:s.u', '2019-02-01 03:45:27.612584');
        $booking = new Booking();
        $booking->booking_start = $start;
        $booking->booking_end = $end;
        $booking->room_id = 1;
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
