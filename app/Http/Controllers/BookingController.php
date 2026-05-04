<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Room;
use App\Models\AddOn;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role === 'Customer') {
            // Customer sees only their bookings
            $bookings = Booking::with(['pet', 'room.roomType', 'addOns'])
                ->where('cusID', auth()->user()->customer->cusID)
                ->orderBy('checkInDate', 'desc')
                ->get();
            return view('bookings.index-customer', compact('bookings'));
        } else {
            // Admin/Staff sees all bookings with optional status filter
            $query = Booking::with(['customer', 'pet', 'room.roomType', 'employee']);
            
            if ($request->has('status') && $request->status) {
                $query->where('status', $request->status);
            }
            
            $bookings = $query->orderBy('checkInDate', 'desc')->get();
            return view('bookings.index', compact('bookings'));
        }
    }

    public function create()
    {
        // Check if this is a customer or admin/staff
        if (auth()->user()->role === 'Customer') {
            // Customer view - only their pets
            $pets = auth()->user()->customer->pets;
            $roomTypes = \App\Models\RoomType::with(['rooms' => function($query) {
                $query->where('status', 'Available');
            }])->get();
            $addOns = AddOn::all();
            return view('bookings.create-customer', compact('pets', 'roomTypes', 'addOns'));
        } else {
            // Admin/Staff view - all customers and pets
            $customers = Customer::all();
            $pets = Pet::all();
            $rooms = Room::where('status', 'Available')->get();
            $addOns = AddOn::all();
            return view('bookings.create', compact('customers', 'pets', 'rooms', 'addOns'));
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cusID' => 'required|exists:Customers,cusID',
            'petID' => 'required|exists:Pets,petID',
            'checkInDate' => 'required|date',
            'checkOutDate' => 'required|date|after:checkInDate',
            'totalAmount' => 'required|numeric|min:0',
        ]);

        // For customers, find an available room of the selected type with capacity
        if ($request->has('roomTypeID')) {
            $rooms = Room::with(['roomType', 'bookings'])
                        ->where('roomTypeID', $request->roomTypeID)
                        ->where('status', '!=', 'Maintenance')
                        ->get();
            
            // Find a room with available capacity
            $room = null;
            foreach ($rooms as $r) {
                if ($r->getAvailableSpots() > 0) {
                    $room = $r;
                    break;
                }
            }
            
            if (!$room) {
                return back()->withErrors(['roomTypeID' => 'No available rooms of this type with capacity.'])->withInput();
            }
            
            $validated['roomID'] = $room->roomID;
        } else {
            // Admin/Staff directly selects room
            $request->validate(['roomID' => 'required|exists:Rooms,roomID']);
            $validated['roomID'] = $request->roomID;
            
            // Check if selected room has capacity
            $room = Room::with(['roomType', 'bookings'])->find($validated['roomID']);
            if ($room->getAvailableSpots() <= 0) {
                return back()->withErrors(['roomID' => 'This room is at full capacity.'])->withInput();
            }
        }

        // Set default status
        $validated['status'] = 'Pending';

        $booking = Booking::create($validated);

        if ($request->has('addOns')) {
            foreach ($request->addOns as $addOnID => $quantity) {
                if ($quantity > 0) {
                    $booking->addOns()->attach($addOnID, ['quantity' => $quantity]);
                }
            }
        }

        // Don't manually set room status - let the dynamic occupancy calculation handle it
        // The room status will be calculated based on actual occupancy vs capacity

        // Redirect based on user role
        if (auth()->user()->role === 'Customer') {
            return redirect()->route('customer.bookings.index')->with('success', 'Booking created successfully! We will confirm your booking soon.');
        } else {
            return redirect()->route('bookings.index')->with('success', 'Booking created successfully');
        }
    }

    public function show($id)
    {
        $booking = Booking::with(['customer', 'pet', 'room', 'employee', 'addOns', 'payment'])->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $customers = Customer::all();
        $pets = Pet::all();
        $rooms = Room::where('status', 'Available')->orWhere('roomID', $booking->roomID)->get();
        $addOns = AddOn::all();
        return view('bookings.edit', compact('booking', 'customers', 'pets', 'rooms', 'addOns'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $validated = $request->validate([
            'cusID' => 'required|exists:Customers,cusID',
            'petID' => 'required|exists:Pets,petID',
            'roomID' => 'required|exists:Rooms,roomID',
            'checkInDate' => 'required|date',
            'checkOutDate' => 'required|date|after:checkInDate',
            'totalAmount' => 'required|numeric|min:0',
            'status' => 'required|in:Pending,Confirmed,Completed,Cancelled',
        ]);

        $booking->update($validated);

        if ($request->has('addOns')) {
            $booking->addOns()->detach();
            foreach ($request->addOns as $addOnID => $quantity) {
                if ($quantity > 0) {
                    $booking->addOns()->attach($addOnID, ['quantity' => $quantity]);
                }
            }
        }

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        // Don't manually update room status - let dynamic occupancy calculation handle it
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        // Don't manually update room status - let dynamic occupancy calculation handle it

        return redirect()->route('bookings.show', $id)->with('success', 'Booking status updated');
    }

    public function verify(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Confirmed,Cancelled,Completed'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        // Don't manually update room status - let dynamic occupancy calculation handle it

        $statusMessages = [
            'Confirmed' => 'Booking has been confirmed successfully!',
            'Cancelled' => 'Booking has been cancelled.',
            'Completed' => 'Booking has been marked as completed.'
        ];

        return redirect()->route('bookings.index')->with('success', $statusMessages[$request->status]);
    }
}
