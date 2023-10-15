<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;

class RoomController extends Controller
{
    public function create()
    {
    }
    public function update()
    {
    }
    public function delete(Request $request)
    {
        $request->validate([
            'room_id' => ['required', 'integer'],
        ]);
        $room = Room::find($request->room_id);
            $room->delete();
    }
}
