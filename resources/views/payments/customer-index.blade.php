<x-customer-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900">
            My Payments
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-green-800">{{ session('success') }}</span>
                </div>
            @endif

            @if($bookings->isEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                    <div class="text-6xl mb-4">💳</div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No active bookings</h3>
                    <p class="text-gray-600 mb-6">You don't have any confirmed bookings that require payment.</p>
                    <a href="{{ route('customer.bookings.create') }}" 
                        class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-8 rounded-xl transition-all">
                        Book a Room
                    </a>
                </div>
            @else
                <div class="mb-6 bg-blue-50 border-2 border-blue-200 rounded-xl p-4">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">💡</span>
                        <div>
                            <p class="text-blue-900 font-semibold">Payment Information</p>
                            <p class="text-blue-700 text-sm">You can make partial payments for your bookings. Pay any amount towards your booking total.</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    @foreach($bookings as $booking)
                        @php
                            $totalPaid = $booking->getTotalPaid();
                            $remaining = $booking->getRemainingBalance();
                            $progress = $booking->getPaymentProgress();
                            $isFullyPaid = $booking->isFullyPaid();
                        @endphp
                        
                        <div class="bg-white rounded-xl shadow-sm border-2 {{ $isFullyPaid ? 'border-green-200' : 'border-orange-200' }} overflow-hidden">
                            <!-- Header -->
                            <div class="bg-gradient-to-r {{ $isFullyPaid ? 'from-green-500 to-green-600' : 'from-orange-500 to-orange-600' }} px-6 py-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="text-white font-bold text-lg">Booking #{{ $booking->bookingID }}</h3>
                                        <p class="text-white text-sm opacity-90">{{ $booking->pet->petName }} - {{ $booking->room->roomType->typeName }}</p>
                                    </div>
                                    <span class="px-3 py-1 bg-white bg-opacity-20 text-white rounded-full text-sm font-semibold">
                                        {{ $booking->status }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <!-- Booking Details -->
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Check-in</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($booking->checkInDate)->format('M d, Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Check-out</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($booking->checkOutDate)->format('M d, Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Room</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $booking->room->roomNum }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Total Amount</p>
                                        <p class="text-sm font-bold text-gray-900">₱{{ number_format($booking->totalAmount, 2) }}</p>
                                    </div>
                                </div>

                                <!-- Payment Progress -->
                                <div class="mb-6">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm font-semibold text-gray-700">Payment Progress</span>
                                        <span class="text-sm font-bold {{ $isFullyPaid ? 'text-green-600' : 'text-orange-600' }}">
                                            {{ number_format($progress, 1) }}%
                                        </span>
                                    </div>
                                    
                                    <!-- Progress Bar -->
                                    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                                        <div class="h-full {{ $isFullyPaid ? 'bg-gradient-to-r from-green-500 to-green-600' : 'bg-gradient-to-r from-orange-500 to-orange-600' }} transition-all duration-500 flex items-center justify-end pr-2"
                                             style="width: {{ $progress }}%">
                                            @if($progress > 15)
                                                <span class="text-xs font-bold text-white">{{ number_format($progress, 0) }}%</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-center mt-2">
                                        <div>
                                            <p class="text-xs text-gray-500">Paid</p>
                                            <p class="text-sm font-bold text-green-600">₱{{ number_format($totalPaid, 2) }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs text-gray-500">Remaining</p>
                                            <p class="text-sm font-bold {{ $isFullyPaid ? 'text-green-600' : 'text-orange-600' }}">
                                                ₱{{ number_format($remaining, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment History -->
                                @if($booking->payments->count() > 0)
                                    <div class="mb-6">
                                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Payment History</h4>
                                        <div class="space-y-2">
                                            @foreach($booking->payments as $payment)
                                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-900">₱{{ number_format($payment->amount, 2) }}</p>
                                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($payment->paymentDate)->format('M d, Y') }} - {{ $payment->paymentMethod }}</p>
                                                    </div>
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                                        {{ $payment->paymentStatus === 'Payment Complete' ? 'bg-green-100 text-green-700' : '' }}
                                                        {{ $payment->paymentStatus === 'Partially Paid' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                                        {{ $payment->paymentStatus === 'Unpaid' ? 'bg-red-100 text-red-700' : '' }}">
                                                        {{ $payment->paymentStatus }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Action Button -->
                                @if(!$isFullyPaid)
                                    <a href="{{ route('customer.payments.create', $booking->bookingID) }}" 
                                       class="block w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-lg text-center transition-all">
                                        Make Payment
                                    </a>
                                @else
                                    <div class="bg-green-50 border-2 border-green-200 rounded-lg p-4 text-center">
                                        <svg class="w-8 h-8 text-green-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <p class="text-green-800 font-semibold">Fully Paid</p>
                                        <p class="text-green-600 text-sm">This booking has been paid in full</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-customer-layout>
