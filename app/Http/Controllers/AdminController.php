<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;
use App\Models\Booking;

class AdminController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $booking = Booking::all();
        return view('admin')
            ->with('rooms', $rooms)
            ->with('booking', $booking);
    }
}
