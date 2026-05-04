<x-customer-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900">
            Dashboard
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        @php
            $customer = auth()->user()->customer;
        @endphp

        <!-- Welcome Message -->
        <div class="mb-8">
            <h3 class="text-3xl font-bold text-gray-900 mb-2">Welcome back, {{ $customer->cusFName }}!</h3>
            <p class="text-gray-500">Here's what's happening with your pets today.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- My Pets -->
            <div class="bg-gradient-to-br from-orange-400 to-orange-500 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-orange-100 text-sm font-medium mb-1">My Pets</p>
                        <p class="text-5xl font-bold">{{ $customer->pets->count() }}</p>
                    </div>
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('customer.pets.index') }}" class="text-orange-100 hover:text-white text-sm font-medium inline-flex items-center">
                    View all pets →
                </a>
            </div>

            <!-- Total Bookings -->
            <div class="bg-gradient-to-br from-amber-400 to-amber-500 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-amber-100 text-sm font-medium mb-1">Total Bookings</p>
                        <p class="text-5xl font-bold">{{ $customer->bookings->count() }}</p>
                    </div>
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('customer.bookings.index') }}" class="text-amber-100 hover:text-white text-sm font-medium inline-flex items-center">
                    View bookings →
                </a>
            </div>

            <!-- Pending -->
            <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-yellow-100 text-sm font-medium mb-1">Pending</p>
                        <p class="text-5xl font-bold">{{ $customer->bookings->where('status', 'Pending')->count() }}</p>
                    </div>
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('customer.bookings.index') }}" class="text-yellow-100 hover:text-white text-sm font-medium inline-flex items-center">
                    View details →
                </a>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mb-8">
            <h4 class="text-xl font-bold text-gray-900 mb-4">Quick Actions</h4>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('customer.pets.create') }}" class="bg-white border-2 border-gray-200 hover:border-orange-300 hover:bg-orange-50 rounded-2xl p-6 text-center transition-all group">
                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-orange-200 transition-all">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-900">Add Pet</p>
                </a>

                <a href="{{ route('customer.rooms.browse') }}" class="bg-white border-2 border-gray-200 hover:border-amber-300 hover:bg-amber-50 rounded-2xl p-6 text-center transition-all group">
                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-amber-200 transition-all">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-900">Browse Rooms</p>
                </a>

                <a href="{{ route('customer.bookings.create') }}" class="bg-white border-2 border-gray-200 hover:border-yellow-300 hover:bg-yellow-50 rounded-2xl p-6 text-center transition-all group">
                    <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-yellow-200 transition-all">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-900">New Booking</p>
                </a>

                <a href="{{ route('customer.payments.index') }}" class="bg-white border-2 border-gray-200 hover:border-orange-300 hover:bg-orange-50 rounded-2xl p-6 text-center transition-all group">
                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-orange-200 transition-all">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-900">Payments</p>
                </a>
            </div>
        </div>

        <!-- Recent Bookings or Empty State -->
        @if($customer->bookings->count() > 0)
        <div>
            <h4 class="text-xl font-bold text-gray-900 mb-4">Recent Bookings</h4>
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pet</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Room</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Check-in</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Check-out</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($customer->bookings->sortByDesc('bookingID')->take(5) as $booking)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900">{{ $booking->pet->petName }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->room->roomNum }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->checkInDate->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->checkOutDate->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($booking->status == 'Confirmed') bg-green-100 text-green-800
                                    @elseif($booking->status == 'Pending') bg-yellow-100 text-yellow-800
                                    @elseif($booking->status == 'Completed') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">₱{{ number_format($booking->totalAmount, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <!-- Empty State -->
        <div class="bg-white border border-gray-200 rounded-2xl p-16 text-center">
            <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">No bookings yet</h3>
            <p class="text-gray-500 mb-8 max-w-md mx-auto">Start by adding your pets and browsing available rooms!</p>
            <a href="{{ route('customer.bookings.create') }}" class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-xl shadow-sm transition-all">
                Make Your First Booking
            </a>
        </div>
        @endif
    </div>
</x-customer-layout>
