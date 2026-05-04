<x-admin-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-green-800">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Customer Info Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="flex items-start justify-between">
                    <div class="flex items-start gap-6">
                        <div class="w-20 h-20 rounded-full bg-blue-600 flex items-center justify-center text-white text-2xl font-bold">
                            {{ strtoupper(substr($customer->cusFName, 0, 1) . substr($customer->cusLName, 0, 1)) }}
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 mb-4">Customer Information</h1>
                            
                            <div class="grid grid-cols-2 gap-x-8 gap-y-2 text-sm">
                                <div class="flex">
                                    <span class="text-gray-500 w-28">cusID:</span>
                                    <span class="text-gray-900 font-medium">{{ $customer->cusID }}</span>
                                </div>
                                @if($customer->user)
                                <div class="flex">
                                    <span class="text-gray-500 w-28">userID:</span>
                                    <span class="text-gray-900 font-medium">{{ $customer->userID }}</span>
                                </div>
                                @endif
                                <div class="flex">
                                    <span class="text-gray-500 w-28">cusFName:</span>
                                    <span class="text-gray-900 font-medium">{{ $customer->cusFName }}</span>
                                </div>
                                @if($customer->cusMName)
                                <div class="flex">
                                    <span class="text-gray-500 w-28">cusMName:</span>
                                    <span class="text-gray-900 font-medium">{{ $customer->cusMName }}</span>
                                </div>
                                @endif
                                <div class="flex">
                                    <span class="text-gray-500 w-28">cusLName:</span>
                                    <span class="text-gray-900 font-medium">{{ $customer->cusLName }}</span>
                                </div>
                                <div class="flex">
                                    <span class="text-gray-500 w-28">phoneNum:</span>
                                    <span class="text-gray-900 font-medium">{{ $customer->phoneNum }}</span>
                                </div>
                                <div class="flex col-span-2">
                                    <span class="text-gray-500 w-28">email:</span>
                                    <span class="text-gray-900 font-medium">{{ $customer->email }}</span>
                                </div>
                                @if($customer->address)
                                <div class="flex col-span-2">
                                    <span class="text-gray-500 w-28">address:</span>
                                    <span class="text-gray-900 font-medium">{{ $customer->address }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('customers.edit', $customer->cusID) }}" 
                           class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                            Edit
                        </a>
                        <a href="{{ route('customers.index') }}" 
                           class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-colors">
                            Back
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pets Section -->
            @if($customer->pets->count() > 0)
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Registered Pets</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($customer->pets as $pet)
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors">
                            <div class="flex items-center gap-3 mb-3">
                                @if($pet->petPhoto)
                                    <img src="{{ asset('storage/' . $pet->petPhoto) }}" alt="{{ $pet->petName }}"
                                         class="w-12 h-12 rounded-full object-cover border border-gray-200">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-2xl">
                                        {{ strtolower($pet->petType) === 'cat' ? '🐱' : (strtolower($pet->petType) === 'dog' ? '🐶' : '🐾') }}
                                    </div>
                                @endif
                                <div>
                                    <h3 class="font-bold text-gray-900">{{ $pet->petName }}</h3>
                                    <p class="text-sm text-gray-500">{{ ucfirst($pet->petType) }}</p>
                                </div>
                            </div>
                            <div class="space-y-1 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Breed:</span>
                                    <span class="text-gray-900 font-medium">{{ $pet->breed }}</span>
                                </div>
                                @if($pet->birthdate)
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Age:</span>
                                    <span class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($pet->birthdate)->age }} years</span>
                                </div>
                                @endif
                                @if($pet->gender)
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Gender:</span>
                                    <span class="text-gray-900 font-medium">{{ ucfirst($pet->gender) }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No pets registered</h3>
                <p class="text-gray-500 mb-4">Add a pet to get started</p>
                <a href="{{ route('pets.create') }}?customer_id={{ $customer->cusID }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add Pet
                </a>
            </div>
            @endif

            <!-- Bookings Section -->
            @if($customer->bookings && $customer->bookings->count() > 0)
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Booking History</h2>
                <div class="space-y-3">
                    @foreach($customer->bookings as $booking)
                        <div class="border border-gray-200 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold">
                                    #{{ $booking->bookingID }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="px-2 py-1 text-xs font-semibold rounded 
                                            @if($booking->status === 'Confirmed') bg-green-100 text-green-700
                                            @elseif($booking->status === 'Pending') bg-yellow-100 text-yellow-700
                                            @elseif($booking->status === 'Completed') bg-blue-100 text-blue-700
                                            @else bg-red-100 text-red-700
                                            @endif">
                                            {{ $booking->status }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($booking->checkInDate)->format('M d, Y') }} - 
                                        {{ \Carbon\Carbon::parse($booking->checkOutDate)->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('bookings.show', $booking->bookingID) }}" 
                               class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">
                                View Details
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</x-admin-layout>
