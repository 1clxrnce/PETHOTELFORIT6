<x-admin-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="mb-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="{{ route('pets.index') }}" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900">Pet Details</h1>
                </div>
                <a href="{{ route('pets.edit', $pet->petID) }}"
                   class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium flex items-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Pet
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left: Photo -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        @if($pet->petPhoto)
                            <img src="{{ asset('storage/' . $pet->petPhoto) }}" alt="{{ $pet->petName }}" class="w-full h-72 object-cover">
                        @else
                            <div class="w-full h-72 bg-gray-100 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-20 h-20 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-gray-400 text-sm">No photo uploaded</p>
                                </div>
                            </div>
                        @endif
                        <div class="p-5 border-t border-gray-100 text-center">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $pet->petName }}</h3>
                            <p class="text-gray-500 text-sm mt-1">{{ $pet->breed }}</p>
                            <span class="mt-2 inline-block px-3 py-1 text-xs font-medium rounded
                                {{ $pet->petType === 'Dog' ? 'bg-blue-50 text-blue-700' : 'bg-purple-50 text-purple-700' }}">
                                {{ $pet->petType }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Right: Details -->
                <div class="lg:col-span-2 space-y-5">
                    <!-- Basic Info -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h4 class="text-base font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-100">Basic Information</h4>
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Customer</p>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $pet->customer->cusFName }} {{ $pet->customer->cusLName }}
                                    <span class="text-gray-400">(#{{ $pet->cusID }})</span>
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Pet ID</p>
                                <p class="text-sm font-medium text-gray-900">#{{ $pet->petID }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Pet Type</p>
                                <p class="text-sm font-medium text-gray-900">{{ $pet->petType }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Breed</p>
                                <p class="text-sm font-medium text-gray-900">{{ $pet->breed }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Gender</p>
                                <p class="text-sm font-medium text-gray-900">{{ $pet->gender }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Size</p>
                                <p class="text-sm font-medium text-gray-900">
                                    @if($pet->weightSize == 'S') Small
                                    @elseif($pet->weightSize == 'M') Medium
                                    @else Large
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Birthdate</p>
                                <p class="text-sm font-medium text-gray-900">{{ $pet->birthdate->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Age</p>
                                <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($pet->birthdate)->age }} years old</p>
                            </div>
                        </div>
                    </div>

                    <!-- Vaccination -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h4 class="text-base font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-100">Vaccination Records</h4>
                        @if($pet->vaccinationFile)
                            <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 bg-green-100 rounded flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-green-800 text-sm">Vaccination File Uploaded</p>
                                        <p class="text-xs text-green-600">Click to view or download</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $pet->vaccinationFile) }}" target="_blank"
                                   class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg">
                                    View File
                                </a>
                            </div>
                        @else
                            <div class="p-4 bg-amber-50 border border-amber-200 rounded-lg text-sm text-amber-800">
                                No vaccination file uploaded.
                            </div>
                        @endif
                    </div>

                    <!-- Booking History -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h4 class="text-base font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-100">Booking History</h4>
                        @if($pet->bookings->count() > 0)
                            <div class="space-y-2">
                                @foreach($pet->bookings->sortByDesc('bookingID') as $booking)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div>
                                            <p class="font-medium text-gray-900 text-sm">Room {{ $booking->room->roomNum }}</p>
                                            <p class="text-xs text-gray-500">{{ $booking->checkInDate->format('M d') }} – {{ $booking->checkOutDate->format('M d, Y') }}</p>
                                        </div>
                                        <span class="px-2.5 py-1 text-xs font-medium rounded
                                            @if($booking->status == 'Confirmed') bg-green-100 text-green-800
                                            @elseif($booking->status == 'Pending') bg-amber-100 text-amber-800
                                            @elseif($booking->status == 'Checked Out') bg-blue-100 text-blue-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ $booking->status }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-gray-400">
                                <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm">No bookings yet</p>
                            </div>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3">
                        <a href="{{ route('pets.edit', $pet->petID) }}"
                           class="flex-1 text-center py-2.5 px-5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-all">
                            Edit Pet
                        </a>
                        <form method="POST" action="{{ route('pets.destroy', $pet->petID) }}" class="flex-1"
                              onsubmit="return confirm('Delete {{ $pet->petName }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full py-2.5 px-5 bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition-all">
                                Delete Pet
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
