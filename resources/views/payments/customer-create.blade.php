<x-customer-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900">
            Make Payment
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $totalPaid = $booking->getTotalPaid();
                $remaining = $booking->getRemainingBalance();
                $progress = $booking->getPaymentProgress();
            @endphp

            <!-- Booking Summary Card -->
            <div class="bg-white rounded-xl shadow-sm border-2 border-orange-200 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4">
                    <h3 class="text-white font-bold text-lg">Booking #{{ $booking->bookingID }}</h3>
                    <p class="text-white text-sm opacity-90">{{ $booking->pet->petName }} - {{ $booking->room->roomType->typeName }}</p>
                </div>

                <div class="p-6">
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
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-semibold text-gray-700">Payment Progress</span>
                            <span class="text-sm font-bold text-orange-600">{{ number_format($progress, 1) }}%</span>
                        </div>
                        
                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden mb-2">
                            <div class="h-full bg-gradient-to-r from-orange-500 to-orange-600 transition-all duration-500"
                                 style="width: {{ $progress }}%"></div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-xs text-gray-500">Already Paid</p>
                                <p class="text-lg font-bold text-green-600">₱{{ number_format($totalPaid, 2) }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500">Remaining Balance</p>
                                <p class="text-lg font-bold text-orange-600">₱{{ number_format($remaining, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <h3 class="text-white font-bold text-lg">Payment Details</h3>
                </div>

                @if($errors->any())
                    <div class="m-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                        <div class="flex">
                            <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('customer.payments.store') }}" method="POST" class="p-6">
                    @csrf
                    <input type="hidden" name="bookingID" value="{{ $booking->bookingID }}">

                    <table class="w-full">
                        <tbody class="divide-y divide-gray-200">
                            <!-- Payment Amount -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700 w-1/3">
                                    Payment Amount <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold">₱</span>
                                        <input type="number" 
                                               name="amount" 
                                               id="amount" 
                                               step="0.01"
                                               min="0.01"
                                               max="{{ $remaining }}"
                                               value="{{ old('amount', $remaining) }}"
                                               required
                                               class="w-full pl-8 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all text-lg font-semibold @error('amount') border-red-500 @enderror">
                                    </div>
                                    @error('amount')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="text-sm text-gray-500 mt-2">
                                        Maximum: ₱{{ number_format($remaining, 2) }} (remaining balance)
                                    </p>
                                    
                                    <!-- Quick Amount Buttons -->
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        <button type="button" onclick="setAmount({{ $remaining }})" 
                                                class="px-3 py-1.5 bg-orange-100 hover:bg-orange-200 text-orange-700 rounded-lg text-sm font-medium transition-all">
                                            Full Amount
                                        </button>
                                        @if($remaining >= 1000)
                                            <button type="button" onclick="setAmount({{ min(1000, $remaining) }})" 
                                                    class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition-all">
                                                ₱1,000
                                            </button>
                                        @endif
                                        @if($remaining >= 500)
                                            <button type="button" onclick="setAmount({{ min(500, $remaining) }})" 
                                                    class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition-all">
                                                ₱500
                                            </button>
                                        @endif
                                        @if($remaining / 2 >= 100)
                                            <button type="button" onclick="setAmount({{ round($remaining / 2, 2) }})" 
                                                    class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition-all">
                                                Half (₱{{ number_format($remaining / 2, 2) }})
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- Payment Method -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Payment Method <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                        <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-orange-300 transition-all">
                                            <input type="radio" name="paymentMethod" value="Cash" {{ old('paymentMethod', 'Cash') == 'Cash' ? 'checked' : '' }} required
                                                   class="w-4 h-4 text-orange-500 border-gray-300 focus:ring-orange-500">
                                            <span class="ml-3 text-sm font-medium text-gray-900">💵 Cash</span>
                                        </label>
                                        <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-orange-300 transition-all">
                                            <input type="radio" name="paymentMethod" value="GCash" {{ old('paymentMethod') == 'GCash' ? 'checked' : '' }} required
                                                   class="w-4 h-4 text-orange-500 border-gray-300 focus:ring-orange-500">
                                            <span class="ml-3 text-sm font-medium text-gray-900">📱 GCash</span>
                                        </label>
                                        <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-orange-300 transition-all">
                                            <input type="radio" name="paymentMethod" value="Bank Transfer" {{ old('paymentMethod') == 'Bank Transfer' ? 'checked' : '' }} required
                                                   class="w-4 h-4 text-orange-500 border-gray-300 focus:ring-orange-500">
                                            <span class="ml-3 text-sm font-medium text-gray-900">🏦 Bank Transfer</span>
                                        </label>
                                    </div>
                                    @error('paymentMethod')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Info Box -->
                    <div class="mt-6 bg-blue-50 border-2 border-blue-200 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <span class="text-xl">ℹ️</span>
                            <div class="text-sm text-blue-800">
                                <p class="font-semibold mb-1">Payment Instructions:</p>
                                <ul class="list-disc list-inside space-y-1 text-blue-700">
                                    <li>You can pay any amount up to the remaining balance</li>
                                    <li>Your payment will be verified by our staff</li>
                                    <li>You can make multiple partial payments until fully paid</li>
                                    <li>For GCash/Bank Transfer, please contact us for payment details</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('customer.payments.index') }}" 
                           class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-lg text-center transition-all">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-lg transition-all">
                            Submit Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function setAmount(amount) {
            document.getElementById('amount').value = amount.toFixed(2);
        }
    </script>
</x-customer-layout>
