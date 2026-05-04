<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'Customer') {
            // Customer sees their bookings with payment progress
            $bookings = Booking::with(['pet', 'room.roomType', 'payments'])
                ->where('cusID', auth()->user()->customer->cusID)
                ->whereIn('status', ['Confirmed', 'Pending'])
                ->orderBy('checkInDate', 'desc')
                ->get();
            return view('payments.customer-index', compact('bookings'));
        } else {
            // Admin/Staff sees all payments
            $payments = Payment::with(['booking.customer'])->orderBy('paymentDate', 'desc')->get();
            return view('payments.index', compact('payments'));
        }
    }

    public function create($bookingID)
    {
        $booking = Booking::with(['customer', 'pet', 'room'])->findOrFail($bookingID);
        return view('payments.create', compact('booking'));
    }

    public function selectBooking()
    {
        // Get bookings that aren't fully paid yet
        $bookings = Booking::with(['customer', 'pet', 'room', 'payments'])
            ->orderBy('checkInDate', 'desc')
            ->get()
            ->filter(function($booking) {
                return !$booking->isFullyPaid();
            });
        
        return view('payments.select-booking', compact('bookings'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'bookingID' => 'required|exists:Bookings,bookingID',
                'paymentDate' => 'required|date',
                'amount' => 'required|numeric|min:0',
                'paymentMethod' => 'required|in:Cash,GCash,Bank Transfer',
            ]);

            // Get the booking to calculate payment status
            $booking = \App\Models\Booking::findOrFail($validated['bookingID']);
            $currentPaid = $booking->getTotalPaid();
            $newTotal = $currentPaid + $validated['amount'];
            
            // Automatically determine payment status
            if ($newTotal >= $booking->totalAmount) {
                $validated['paymentStatus'] = 'Payment Complete';
            } elseif ($newTotal > 0) {
                $validated['paymentStatus'] = 'Partially Paid';
            } else {
                $validated['paymentStatus'] = 'Unpaid';
            }

            Payment::create($validated);

            return redirect()->route('bookings.show', $validated['bookingID'])->with('success', 'Payment recorded successfully');
        } catch (\Exception $e) {
            \Log::error('Payment creation error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to create payment: ' . $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        $payment = Payment::with(['booking.customer', 'booking.pet', 'booking.room.roomType'])->findOrFail($id);
        return view('payments.show', compact('payment'));
    }

    public function edit($id)
    {
        $payment = Payment::with('booking')->findOrFail($id);
        return view('payments.edit', compact('payment'));
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        
        $validated = $request->validate([
            'paymentDate' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'paymentMethod' => 'required|in:Cash,GCash,Bank Transfer',
            'paymentStatus' => 'required|in:Payment Complete,Partially Paid,Unpaid',
        ]);

        $payment->update($validated);

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully');
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully');
    }

    // Customer payment methods
    public function customerCreate($bookingID)
    {
        $booking = Booking::with(['pet', 'room.roomType', 'payments'])
            ->where('cusID', auth()->user()->customer->cusID)
            ->findOrFail($bookingID);
        
        return view('payments.customer-create', compact('booking'));
    }

    public function customerStore(Request $request)
    {
        $validated = $request->validate([
            'bookingID' => 'required|exists:Bookings,bookingID',
            'amount' => 'required|numeric|min:0.01',
            'paymentMethod' => 'required|in:Cash,GCash,Bank Transfer',
        ]);

        // Verify the booking belongs to the customer
        $booking = Booking::where('bookingID', $validated['bookingID'])
            ->where('cusID', auth()->user()->customer->cusID)
            ->firstOrFail();

        // Check if payment amount doesn't exceed remaining balance
        $remainingBalance = $booking->getRemainingBalance();
        if ($validated['amount'] > $remainingBalance) {
            return back()->withErrors(['amount' => 'Payment amount cannot exceed remaining balance of ₱' . number_format($remainingBalance, 2)])->withInput();
        }

        // Create payment
        $validated['paymentDate'] = now();
        $validated['paymentStatus'] = ($validated['amount'] >= $remainingBalance) ? 'Payment Complete' : 'Partially Paid';

        Payment::create($validated);

        return redirect()->route('customer.payments.index')->with('success', 'Payment submitted successfully! Our staff will verify your payment shortly.');
    }
}
