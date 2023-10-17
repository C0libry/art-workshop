<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AddRoomRequest;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function create(AddRoomRequest $request)
    {
        // dd('1');
        $room = new Room();
        $room->name = $request->name;
        $room->address = $request->address;
        $room->description = $request->description;

        if ($request->file('image')) {
            $path = 'public/images/rooms';
            $path = Storage::disk('public_uploads')->put($path, $request->file('image'));
            $room->image = 'uploads/' . $path;
        } else
            $room->image = 'img/room1.jpg';

        $room->save();
        return redirect()->route('admin.index');
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
