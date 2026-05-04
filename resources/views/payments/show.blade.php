<x-admin-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('payments.index') }}" 
                       class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">Payment Details</h1>
                </div>
                <p class="text-gray-600">Payment ID: #{{ $payment->paymentID }}</p>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-green-800">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Payment Information Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Payment Information</h2>
                </div>
                
                <div class="p-6">
                    <table class="w-full">
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700 w-1/3">Payment ID</td>
                                <td class="py-3 text-sm text-gray-900">{{ $payment->paymentID }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Booking ID</td>
                                <td class="py-3 text-sm text-gray-900">
                                    <a href="{{ route('bookings.show', $payment->bookingID) }}" class="text-blue-600 hover:underline">
                                        #{{ $payment->bookingID }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Payment Date</td>
                                <td class="py-3 text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($payment->paymentDate)->format('F d, Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Amount</td>
                                <td class="py-3 text-sm text-gray-900">
                                    <span class="text-lg font-bold text-green-600">₱{{ number_format($payment->amount, 2) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Payment Method</td>
                                <td class="py-3 text-sm text-gray-900">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">
                                        {{ $payment->paymentMethod }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Payment Status</td>
                                <td class="py-3 text-sm text-gray-900">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                                        @if($payment->paymentStatus === 'Payment Complete') bg-green-100 text-green-700
                                        @elseif($payment->paymentStatus === 'Partially Paid') bg-yellow-100 text-yellow-700
                                        @else bg-red-100 text-red-700
                                        @endif">
                                        {{ $payment->paymentStatus }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Booking Information Card -->
            @if($payment->booking)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Related Booking Information</h2>
                </div>
                
                <div class="p-6">
                    <table class="w-full">
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700 w-1/3">Customer</td>
                                <td class="py-3 text-sm text-gray-900">
                                    @if($payment->booking->customer)
                                        <a href="{{ route('customers.show', $payment->booking->customer->cusID) }}" class="text-blue-600 hover:underline">
                                            {{ $payment->booking->customer->cusFName }} {{ $payment->booking->customer->cusLName }}
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Pet</td>
                                <td class="py-3 text-sm text-gray-900">
                                    @if($payment->booking->pet)
                                        {{ $payment->booking->pet->petName }} ({{ $payment->booking->pet->petType }})
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Room</td>
                                <td class="py-3 text-sm text-gray-900">
                                    @if($payment->booking->room)
                                        Room {{ $payment->booking->room->roomNum }} - {{ $payment->booking->room->roomType->typeName ?? 'N/A' }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Check-in Date</td>
                                <td class="py-3 text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($payment->booking->checkInDate)->format('F d, Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Check-out Date</td>
                                <td class="py-3 text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($payment->booking->checkOutDate)->format('F d, Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Booking Total</td>
                                <td class="py-3 text-sm text-gray-900">
                                    ₱{{ number_format($payment->booking->totalAmount, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Booking Status</td>
                                <td class="py-3 text-sm text-gray-900">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                                        @if($payment->booking->status === 'Confirmed') bg-green-100 text-green-700
                                        @elseif($payment->booking->status === 'Pending') bg-yellow-100 text-yellow-700
                                        @elseif($payment->booking->status === 'Completed') bg-blue-100 text-blue-700
                                        @else bg-red-100 text-red-700
                                        @endif">
                                        {{ $payment->booking->status }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <a href="{{ route('payments.edit', $payment->paymentID) }}" 
                   class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-lg text-center transition-all">
                    Edit Payment
                </a>
                <form action="{{ route('payments.destroy', $payment->paymentID) }}" method="POST" class="flex-1"
                      onsubmit="return confirm('Are you sure you want to delete this payment? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg transition-all">
                        Delete Payment
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
