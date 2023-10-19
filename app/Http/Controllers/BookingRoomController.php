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
        else
            $booking_start = $request->booking_start;

        if (strlen($request->booking_end) == 1)
            $booking_end = '0' . $request->booking_end;
        else
            $booking_end = $request->booking_end;

        $start = Carbon::createFromFormat('d.m.Y H', $request->booking_date . ' ' . $booking_start);
        $end = Carbon::createFromFormat('d.m.Y H', $request->booking_date . ' ' . $booking_end);
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
    public function get_boking_on_day($date)
    {
        $start = Carbon::parse($date . ' 00:00:00', 'UTC'); //Carbon::createFromFormat('d.m.Y H:mm:ss', $date . ' 00:00:00');
        // $end = Carbon::createFromFormat('d.m.Y H:mm:ss', $date . ' 23:59:59');
        $end = Carbon::parse($date . ' 23:59:59', 'UTC');
        $booking = Booking::query()->whereBetween('booking_start', [$start, $end])->get();
        return $booking;
    }
}
