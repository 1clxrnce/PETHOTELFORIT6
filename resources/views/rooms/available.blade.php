<x-customer-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900">
            Available Rooms
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($rooms->isEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-16 text-center">
                    <div class="text-8xl mb-6">🏠</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">No rooms available</h3>
                    <p class="text-gray-600 text-lg mb-8 max-w-md mx-auto">All rooms are currently occupied. Please check back later or contact us for more information.</p>
                    <a href="{{ route('dashboard') }}" 
                        class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold py-4 px-10 rounded-xl transition-all shadow-sm hover:shadow-md">
                        Back to Dashboard
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($rooms as $room)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300">
                            <!-- Room Photo -->
                            @if($room->roomPhoto)
                                <div class="h-48 bg-gray-100 overflow-hidden">
                                    <img src="{{ asset('storage/' . $room->roomPhoto) }}" 
                                        alt="Room {{ $room->roomNum }}" 
                                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                </div>
                            @else
                                <div class="h-48 bg-gradient-to-br from-orange-100 to-orange-200 flex items-center justify-center">
                                    <span class="text-7xl">🏠</span>
                                </div>
                            @endif

                            <!-- Room Details -->
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">Room {{ $room->roomNum }}</h3>
                                        <p class="text-sm font-medium text-orange-600 mt-0.5">{{ $room->roomType->typeName }}</p>
                                    </div>
                                    @php
                                        $current = $room->getCurrentOccupancy();
                                        $max = $room->roomType->maxCapacity ?? 0;
                                        $available = $room->getAvailableSpots();
                                    @endphp
                                    <div class="text-right">
                                        <span class="px-2.5 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full block mb-1">
                                            {{ $available }} spot{{ $available > 1 ? 's' : '' }} left
                                        </span>
                                        <span class="text-xs text-gray-500">{{ $current }}/{{ $max }} pets</span>
                                    </div>
                                </div>

                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $room->roomType->description }}</p>

                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 rounded-lg">
                                        <span class="text-xs text-gray-600 flex items-center gap-1.5">
                                            <span>🐾</span> Max Capacity
                                        </span>
                                        <span class="text-sm font-semibold text-gray-900">{{ $room->roomType->maxCapacity }} pet{{ $room->roomType->maxCapacity > 1 ? 's' : '' }}</span>
                                    </div>

                                    <div class="flex items-center justify-between py-2 px-3 bg-orange-50 rounded-lg">
                                        <span class="text-xs text-gray-700 font-medium">Per Night</span>
                                        <span class="text-xl font-bold text-orange-600">₱{{ number_format($room->roomType->pricePerNight, 2) }}</span>
                                    </div>
                                </div>

                                <a href="{{ route('customer.bookings.create', ['roomType' => $room->roomType->roomTypeID]) }}" 
                                    class="block w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-4 rounded-lg text-center transition-all text-sm">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10 text-center bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <p class="text-gray-600 mb-3 text-sm">Ready to book a room for your pet?</p>
                    <a href="{{ route('customer.bookings.create') }}" 
                        class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-8 rounded-lg transition-all">
                        Book a Room →
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-customer-layout>
