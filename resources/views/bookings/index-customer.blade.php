<x-customer-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-900">
                My Bookings
            </h2>
            <a href="{{ route('customer.bookings.create') }}" 
                class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-xl transition-all shadow-sm hover:shadow-md">
                + New Booking
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-2 border-green-200 text-green-800 px-6 py-4 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            @if($bookings->isEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                    <div class="text-6xl mb-4">🏠</div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No bookings yet</h3>
                    <p class="text-gray-600 mb-6">Start by booking a room for your pet!</p>
                    <a href="{{ route('customer.bookings.create') }}" 
                        class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-8 rounded-xl transition-all">
                        Book a Room
                    </a>
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Booking ID</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Customer ID</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Pet ID</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Room ID</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Employee ID</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Check-in Date</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Check-out Date</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Total Amount</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($bookings as $booking)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $booking->bookingID }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $booking->cusID }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $booking->petID }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $booking->roomID }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $booking->empID ?? '-' }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $booking->checkInDate->format('Y-m-d') }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $booking->checkOutDate->format('Y-m-d') }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                            ₱{{ number_format($booking->totalAmount, 2) }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $booking->status === 'Confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $booking->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $booking->status === 'Completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $booking->status === 'Cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ $booking->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6 text-sm text-gray-600">
                    <p>Total Bookings: <span class="font-semibold">{{ $bookings->count() }}</span></p>
                </div>
            @endif
        </div>
    </div>
</x-customer-layout>
