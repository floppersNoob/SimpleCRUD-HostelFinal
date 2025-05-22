<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class HostelController extends Controller
{
        public function index()
    {
        $rooms = Room::where('archived_stat',  0)->get();
        return response()->json($rooms);
    }

    public function store(Request $request)
    {
        $request->validate([
        'room_number' => 'required|string|max:255|unique:rooms,room_number',
        'type' => 'required|string|max:255',
        'price_per_night' => 'required|numeric|min:0',
    ]);
        $room = Room::create([
            'room_number' => $request->room_number,
            'type' => $request->type,
            'price_per_night' => $request->price_per_night,
            'status' => 'Available',
        ]);
        return response()->json($room, 200);
    }

    public function update(Request $request, $id)
    {   
        $room = Room::find($id);
        if ($room->status === 'Reserved') {
            return response()->json(['error' => 'Cannot update an occupied or unavailable room.'], 403);
        }
        $request->validate([
            'room_number' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
        ]);
        $room->update([
            'room_number' => $request->room_number,
            'type' => $request->type,
            'price_per_night' => $request->price_per_night,
        ]);
        return response()->json(['message' => 'Room updated successfully.'], 200);
    }

    public function archive($id)
    {
        $room = Room::find($id);
        $room->archived_stat = 1;
        $room->save();

        return response()->json(['message' => 'Room archived successfully.'], 200);
    }

    public function archived()
    {
        $rooms = Room::where('archived_stat', 1)->get();
        return response()->json($rooms);
    }

    public function recover($id)
    {
        $room = Room::find($id);
        $room->update(['archived_stat' => 0]);
        return response()->json(['message' => 'Room recovered successfully.'], 200);
    }
}
