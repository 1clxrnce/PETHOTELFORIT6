<x-customer-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900">
            Payment History
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($payments->isEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                    <div class="text-6xl mb-4">💳</div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No payment history</h3>
                    <p class="text-gray-600 mb-6">You don't have any payment records yet. Make a booking to see payment information here.</p>
                    <a href="{{ route('customer.bookings.create') }}" 
                        class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-8 rounded-xl transition-all">
                        Book a Room
                    </a>
                </div>
            @else
                <div class="mb-6 bg-blue-50 border-2 border-blue-200 rounded-xl p-4">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">ℹ️</span>
                        <div>
                            <p class="text-blue-900 font-semibold">Payment Information</p>
                            <p class="text-blue-700 text-sm">This shows your payment history and status. Payments are processed by our staff - you cannot pay directly through this website.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Payment ID</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Booking ID</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Pet & Room</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Payment Date</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Amount</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Method</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($payments as $payment)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $payment->paymentID }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $payment->bookingID }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
                                            <div>
                                                <p class="font-medium">{{ $payment->booking->pet->petName }}</p>
                                                <p class="text-xs text-gray-500">{{ $payment->booking->room->roomType->typeName }}</p>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ \Carbon\Carbon::parse($payment->paymentDate)->format('M d, Y') }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                            ₱{{ number_format($payment->amount, 2) }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $payment->paymentMethod }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $payment->paymentStatus === 'Payment Complete' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $payment->paymentStatus === 'Partially Paid' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $payment->paymentStatus === 'Unpaid' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ $payment->paymentStatus }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6 text-sm text-gray-600">
                    <p>Total Payment Records: <span class="font-semibold">{{ $payments->count() }}</span></p>
                </div>

                <div class="mt-6 bg-orange-50 border-2 border-orange-200 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <span class="text-2xl">💡</span>
                        <div>
                            <p class="text-orange-900 font-semibold mb-1">Payment Instructions</p>
                            <ul class="text-orange-700 text-sm space-y-1">
                                <li>• Payments are processed by our staff at the hotel</li>
                                <li>• You can pay via Cash, GCash, or Bank Transfer</li>
                                <li>• Contact us for payment arrangements</li>
                                <li>• Payment status will be updated here once processed</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-customer-layout>