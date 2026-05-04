<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 mb-2">
                    Booking Management
                </h2>
                <p class="text-gray-600">Manage and verify customer bookings</p>
            </div>
            <a href="{{ route('bookings.create') }}" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                New Booking
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-400 text-green-800 px-6 py-4 rounded-r-xl mb-8 shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Status Filter -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter by Status</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('bookings.index') }}" 
                        class="px-6 py-3 rounded-xl font-medium transition-all {{ !request('status') ? 'bg-blue-600 text-white shadow-lg' : 'bg-gray-50 text-gray-700 hover:bg-gray-100 hover:shadow-md' }}">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            All Bookings
                        </span>
                    </a>
                    <a href="{{ route('bookings.index', ['status' => 'Pending']) }}" 
                        class="px-6 py-3 rounded-xl font-medium transition-all {{ request('status') == 'Pending' ? 'bg-yellow-500 text-white shadow-lg' : 'bg-gray-50 text-gray-700 hover:bg-gray-100 hover:shadow-md' }}">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            Pending
                        </span>
                    </a>
                    <a href="{{ route('bookings.index', ['status' => 'Confirmed']) }}" 
                        class="px-6 py-3 rounded-xl font-medium transition-all {{ request('status') == 'Confirmed' ? 'bg-green-600 text-white shadow-lg' : 'bg-gray-50 text-gray-700 hover:bg-gray-100 hover:shadow-md' }}">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Confirmed
                        </span>
                    </a>
                    <a href="{{ route('bookings.index', ['status' => 'Completed']) }}" 
                        class="px-6 py-3 rounded-xl font-medium transition-all {{ request('status') == 'Completed' ? 'bg-blue-600 text-white shadow-lg' : 'bg-gray-50 text-gray-700 hover:bg-gray-100 hover:shadow-md' }}">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Completed
                        </span>
                    </a>
                    <a href="{{ route('bookings.index', ['status' => 'Cancelled']) }}" 
                        class="px-6 py-3 rounded-xl font-medium transition-all {{ request('status') == 'Cancelled' ? 'bg-red-600 text-white shadow-lg' : 'bg-gray-50 text-gray-700 hover:bg-gray-100 hover:shadow-md' }}">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Cancelled
                        </span>
                    </a>
                </div>
            </div>

            <!-- Bookings List -->
            <div class="space-y-3 mb-8">
                @forelse($bookings as $booking)
                    <div class="bg-white rounded-xl border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all">
                        <div class="p-5 flex flex-col lg:flex-row lg:items-center gap-5">

                            <!-- Booking ID + Status -->
                            <div class="flex items-center gap-3 min-w-[140px]">
                                <span class="text-sm font-bold text-gray-900">#{{ $booking->bookingID }}</span>
                                @php
                                    $statusColors = [
                                        'Pending'   => 'bg-yellow-100 text-yellow-800',
                                        'Confirmed' => 'bg-green-100 text-green-800',
                                        'Checked In'  => 'bg-blue-100 text-blue-800',
                                        'Checked Out' => 'bg-gray-100 text-gray-700',
                                        'Cancelled' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ $booking->status }}
                                </span>
                            </div>

                            <!-- Customer -->
                            <div class="flex items-center gap-3 min-w-[160px]">
                                <div class="w-9 h-9 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-bold shrink-0">
                                    {{ substr($booking->customer->cusFName, 0, 1) }}{{ substr($booking->customer->cusLName, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $booking->customer->cusFName }} {{ $booking->customer->cusLName }}</p>
                                    <p class="text-xs text-gray-500">Customer #{{ $booking->cusID }}</p>
                                </div>
                            </div>

                            <!-- Pet -->
                            <div class="flex items-center gap-3 min-w-[140px]">
                                @if($booking->pet->petPhoto)
                                    <img src="{{ asset('storage/' . $booking->pet->petPhoto) }}" class="w-9 h-9 rounded-full object-cover border border-gray-200 shrink-0">
                                @else
                                    <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $booking->pet->petName }}</p>
                                    <p class="text-xs text-gray-500">{{ $booking->pet->petType }} · Room {{ $booking->room->roomNum }}</p>
                                </div>
                            </div>

                            <!-- Dates -->
                            <div class="min-w-[180px]">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $booking->checkInDate->format('M d') }} – {{ $booking->checkOutDate->format('M d, Y') }}
                                </p>
                                <p class="text-xs text-gray-500">{{ $booking->checkInDate->diffInDays($booking->checkOutDate) }} nights</p>
                            </div>

                            <!-- Amount -->
                            <div class="min-w-[100px]">
                                <p class="text-sm font-bold text-gray-900">₱{{ number_format($booking->totalAmount, 2) }}</p>
                                <p class="text-xs text-gray-500">Total</p>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center gap-2 ml-auto shrink-0">
                                @if($booking->status === 'Pending')
                                    <form method="POST" action="{{ route('bookings.verify', $booking->bookingID) }}">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="Confirmed">
                                        <button type="submit"
                                                onclick="return confirm('Confirm this booking?')"
                                                class="px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-lg transition-all">
                                            Confirm
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('bookings.verify', $booking->bookingID) }}">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="Cancelled">
                                        <button type="submit"
                                                onclick="return confirm('Cancel this booking?')"
                                                class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded-lg transition-all">
                                            Cancel
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('bookings.show', $booking->bookingID) }}"
                                   class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition-all">
                                    View
                                </a>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-12 text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">No bookings found</h3>
                        <p class="text-gray-600 mb-6">There are no bookings matching your current filter.</p>
                        <a href="{{ route('bookings.create') }}" 
                            class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Create New Booking
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>