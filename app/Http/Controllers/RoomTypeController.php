<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::withCount('rooms')->get();
        return view('roomtypes.index', compact('roomTypes'));
    }

    public function create()
    {
        return view('roomtypes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'typeName' => 'required|unique:RoomTypes,typeName|in:Standard,Luxury',
            'description' => 'nullable',
            'pricePerNight' => 'required|numeric|min:0',
            'maxCapacity' => 'required|integer|min:1',
        ]);

        RoomType::create($validated);

        return redirect()->route('roomtypes.index')->with('success', 'Room type created successfully');
    }

    public function show($id)
    {
        $roomType = RoomType::with('rooms')->findOrFail($id);
        return view('roomtypes.show', compact('roomType'));
    }

    public function edit($id)
    {
        $roomType = RoomType::findOrFail($id);
        return view('roomtypes.edit', compact('roomType'));
    }

    public function update(Request $request, $id)
    {
        $roomType = RoomType::findOrFail($id);
        
        $validated = $request->validate([
            'typeName' => 'required|in:Standard,Luxury|unique:RoomTypes,typeName,' . $id . ',roomTypeID',
            'description' => 'nullable',
            'pricePerNight' => 'required|numeric|min:0',
            'maxCapacity' => 'required|integer|min:1',
        ]);

        $roomType->update($validated);

        return redirect()->route('roomtypes.index')->with('success', 'Room type updated successfully');
    }

    public function destroy($id)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->delete();

        return redirect()->route('roomtypes.index')->with('success', 'Room type deleted successfully');
    }
}
