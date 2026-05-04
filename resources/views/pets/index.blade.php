<x-customer-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 mb-1">
                    My Pets
                </h2>
                <p class="text-gray-500 text-sm">Manage your registered pets</p>
            </div>
            <a href="{{ route('customer.pets.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-lg inline-flex items-center shadow-sm transition-all">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Pet
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg shadow-sm" role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="font-semibold text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @php
            $customer = auth()->user()->customer;
            $pets = $customer->pets;
        @endphp

        @if($pets->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($pets as $pet)
                    <a href="{{ route('customer.pets.show', $pet->petID) }}" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md hover:border-orange-300 transition-all group cursor-pointer">
                        <!-- Pet Photo -->
                        <div class="relative h-48 bg-gray-100 overflow-hidden">
                            @if($pet->petPhoto)
                                <img src="{{ asset('storage/' . $pet->petPhoto) }}" alt="{{ $pet->petName }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Vaccinated Badge -->
                            @if($pet->vaccinationFile)
                            <div class="absolute top-3 right-3">
                                <span class="px-2.5 py-1 text-xs font-semibold rounded bg-green-500 text-white shadow flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Vaccinated
                                </span>
                            </div>
                            @endif
                        </div>

                        <!-- Pet Info -->
                        <div class="p-5">
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-orange-600 transition-colors mb-1">{{ $pet->petName }}</h3>
                                <p class="text-sm text-gray-500">{{ $pet->breed }}</p>
                            </div>

                            <!-- Pet Details Grid -->
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <div class="bg-gray-50 rounded p-2.5">
                                    <p class="text-xs text-gray-500 mb-0.5">Type</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $pet->petType }}</p>
                                </div>
                                <div class="bg-gray-50 rounded p-2.5">
                                    <p class="text-xs text-gray-500 mb-0.5">Size</p>
                                    <p class="text-sm font-medium text-gray-900">
                                        @if($pet->weightSize == 'S') Small
                                        @elseif($pet->weightSize == 'M') Medium
                                        @else Large
                                        @endif
                                    </p>
                                </div>
                                <div class="bg-gray-50 rounded p-2.5">
                                    <p class="text-xs text-gray-500 mb-0.5">Gender</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $pet->gender }}</p>
                                </div>
                                <div class="bg-gray-50 rounded p-2.5">
                                    <p class="text-xs text-gray-500 mb-0.5">Age</p>
                                    <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($pet->birthdate)->age }} yrs</p>
                                </div>
                            </div>

                            <!-- View Details Button -->
                            <div class="flex items-center justify-center text-orange-600 font-medium text-sm group-hover:text-orange-700">
                                View Details
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-16 text-center">
                <!-- Icon -->
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-5">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                
                <!-- Text -->
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No pets registered</h3>
                <p class="text-gray-500 text-sm mb-6 max-w-md mx-auto">Add your first pet to start booking rooms and managing their stays.</p>
                
                <!-- CTA Button -->
                <a href="{{ route('customer.pets.create') }}" class="inline-flex items-center bg-orange-500 hover:bg-orange-600 text-white font-medium py-2.5 px-5 rounded-lg shadow-sm transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Pet
                </a>
            </div>
        @endif
    </div>
</x-customer-layout>
