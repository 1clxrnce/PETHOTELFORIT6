<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('roomType')->get();
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        $roomTypes = RoomType::all();
        return view('rooms.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'roomTypeID' => 'required|exists:RoomTypes,roomTypeID',
            'roomNum' => 'required|unique:Rooms,roomNum',
            'roomPhoto' => 'nullable|image|max:2048',
            'status' => 'required|in:Available,Occupied,Maintenance',
        ]);

        if ($request->hasFile('roomPhoto')) {
            $validated['roomPhoto'] = $request->file('roomPhoto')->store('rooms', 'public');
        }

        Room::create($validated);

        return redirect()->route('rooms.index')->with('success', 'Room created successfully');
    }

    public function show($id)
    {
        $room = Room::with(['roomType', 'bookings'])->findOrFail($id);
        return view('rooms.show', compact('room'));
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $roomTypes = RoomType::all();
        return view('rooms.edit', compact('room', 'roomTypes'));
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        
        $validated = $request->validate([
            'roomTypeID' => 'required|exists:RoomTypes,roomTypeID',
            'roomNum' => 'required|unique:Rooms,roomNum,' . $id . ',roomID',
            'roomPhoto' => 'nullable|image|max:2048',
            'status' => 'required|in:Available,Occupied,Maintenance',
        ]);

        if ($request->hasFile('roomPhoto')) {
            $validated['roomPhoto'] = $request->file('roomPhoto')->store('rooms', 'public');
        }

        $room->update($validated);

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully');
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully');
    }

    public function available()
    {
        // Get all rooms that are not under maintenance and have available capacity
        $rooms = Room::with(['roomType', 'bookings'])
            ->where('status', '!=', 'Maintenance')
            ->get()
            ->filter(function($room) {
                return $room->getAvailableSpots() > 0;
            });
        
        return view('rooms.available', compact('rooms'));
    }
}
