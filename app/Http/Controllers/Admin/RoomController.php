<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $room = Room::all();
        return view('admin.room.index', compact('room'));
    }
    public function show(string $RoomID)
    {
        $room = Room::findOrFail($RoomID);
        $bookings = Booking::where('RoomID', $RoomID)->get();

        // Pass data to the view
        return view('admin.room.detail', compact('room', 'bookings'));
    }
    public function available($RoomID)
    {
        $room = Room::findOrFail($RoomID);
        $room->update(['Status' => 'Available']);
        return redirect()->route('admin.room.index')->with('success', 'Room is now available.');
    }

    public function occupied($RoomID)
    {
        $room = Room::findOrFail($RoomID);
        $room->update(['Status' => 'Occupied']);
        return redirect()->route('admin.room.index')->with('success', 'Room is now occupied.');
    }

    public function maintenance($RoomID)
    {
        $room = Room::findOrFail($RoomID);
        $room->update(['Status' => 'Maintenance']);
        return redirect()->route('admin.room.index')->with('success', 'Room is under maintenance.');
    }
}
