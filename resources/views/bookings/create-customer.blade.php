<x-customer-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900">
            Book a Room
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form method="POST" action="{{ route('customer.bookings.store') }}" id="bookingForm">
                @csrf

                <input type="hidden" name="cusID" value="{{ auth()->user()->customer->cusID }}">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column - Booking Details -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-orange-50 border border-orange-200 rounded-xl p-4">
                            <h3 class="font-semibold text-orange-900 mb-2">📋 Booking Information</h3>
                            <p class="text-sm text-orange-700">Fill in the details below to book a room for your pet</p>
                        </div>

                        <!-- Booking IDs Display -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1">Booking ID</label>
                                <input type="text" value="Auto-generated" readonly
                                    class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1">Customer ID</label>
                                <input type="text" value="{{ auth()->user()->customer->cusID }}" readonly
                                    class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1">Pet ID</label>
                                <input type="text" id="displayPetID" value="-" readonly
                                    class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1">Room ID</label>
                                <input type="text" id="displayRoomID" value="Auto-assigned" readonly
                                    class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
                            </div>
                        </div>

                        <!-- Select Pet -->
                        <div>
                            <label for="petID" class="block text-sm font-semibold text-gray-700 mb-2">Select Your Pet *</label>
                            <select name="petID" id="petID" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all appearance-none bg-white"
                                style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em 1.5em;">
                                <option value="">Choose a pet</option>
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->petID }}" data-size="{{ $pet->weightSize }}" {{ old('petID') == $pet->petID ? 'selected' : '' }}>
                                        {{ $pet->petName }} ({{ $pet->petType }} - {{ $pet->weightSize }})
                                    </option>
                                @endforeach
                            </select>
                            @error('petID')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            @if($pets->isEmpty())
                                <p class="text-sm text-orange-600 mt-2">
                                    You need to <a href="{{ route('customer.pets.create') }}" class="underline font-semibold">add a pet</a> before booking.
                                </p>
                            @endif
                        </div>

                        <!-- Check-in Date -->
                        <div>
                            <label for="checkInDate" class="block text-sm font-semibold text-gray-700 mb-2">Check-in Date *</label>
                            <input type="date" name="checkInDate" id="checkInDate" value="{{ old('checkInDate') }}" required
                                min="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all">
                            @error('checkInDate')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Check-out Date -->
                        <div>
                            <label for="checkOutDate" class="block text-sm font-semibold text-gray-700 mb-2">Check-out Date *</label>
                            <input type="date" name="checkOutDate" id="checkOutDate" value="{{ old('checkOutDate') }}" required
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all">
                            @error('checkOutDate')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-sm text-gray-500 mt-1" id="nightsDisplay"></p>
                        </div>

                        <!-- Room Type Selection -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Select Room Type *</label>
                            @if(request('roomType'))
                                <p class="text-sm text-gray-600 mb-3 bg-blue-50 border border-blue-200 rounded-lg p-3">
                                    <span class="font-semibold">Room type pre-selected.</span> This room type was chosen from the available rooms page.
                                </p>
                            @endif
                            <div class="space-y-3">
                                @foreach($roomTypes as $roomType)
                                    @php
                                        // Get rooms with available capacity (not just status = 'Available')
                                        $availableRooms = $roomType->rooms->filter(function($room) {
                                            return $room->status !== 'Maintenance' && $room->getAvailableSpots() > 0;
                                        });
                                        $isPreSelected = request('roomType') == $roomType->roomTypeID;
                                        // Only show the pre-selected room type if coming from available rooms
                                        if (request('roomType') && !$isPreSelected) {
                                            continue;
                                        }
                                    @endphp
                                    <label class="block cursor-pointer">
                                        <input type="radio" name="roomTypeID" value="{{ $roomType->roomTypeID }}" 
                                            data-price="{{ $roomType->pricePerNight }}"
                                            data-type-name="{{ $roomType->typeName }}"
                                            class="hidden room-type-radio" 
                                            {{ old('roomTypeID', request('roomType')) == $roomType->roomTypeID ? 'checked' : '' }}
                                            {{ $availableRooms->isEmpty() ? 'disabled' : '' }}>
                                        <div class="room-type-card border-2 rounded-xl p-4 transition-all {{ $availableRooms->isEmpty() ? 'bg-gray-50 border-gray-200 opacity-60' : 'border-gray-200 hover:border-orange-300' }}">
                                            <div class="flex justify-between items-start">
                                                <div class="flex-1">
                                                    <h4 class="font-semibold text-lg text-gray-900">
                                                        {{ $roomType->typeName }}
                                                        @if($isPreSelected)
                                                            <span class="ml-2 text-xs bg-orange-100 text-orange-700 px-2 py-1 rounded-full">Selected</span>
                                                        @endif
                                                        <span class="ml-2 text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">ID: {{ $roomType->roomTypeID }}</span>
                                                    </h4>
                                                    <p class="text-sm text-gray-600 mt-1">{{ $roomType->description }}</p>
                                                    <div class="flex items-center gap-4 mt-2 text-sm text-gray-500">
                                                        <span>🐾 Max {{ $roomType->maxCapacity }} pet(s)</span>
                                                        <span>🏠 {{ $availableRooms->count() }} available</span>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-2xl font-bold text-orange-600">₱{{ number_format($roomType->pricePerNight, 2) }}</p>
                                                    <p class="text-xs text-gray-500">per night</p>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @error('roomTypeID')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Add-ons -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Add-ons (Optional)</label>
                            <div class="space-y-2">
                                @foreach($addOns as $addOn)
                                    <label class="flex items-center justify-between p-4 border-2 border-gray-200 rounded-xl hover:border-orange-300 transition-all cursor-pointer">
                                        <div class="flex items-center gap-3 flex-1">
                                            <input type="checkbox" 
                                                name="addOns[{{ $addOn->addOnID }}]" 
                                                value="1"
                                                data-price="{{ $addOn->price }}"
                                                data-name="{{ $addOn->addOnName }}"
                                                class="addon-checkbox w-5 h-5 text-orange-500 border-gray-300 rounded focus:ring-orange-500 focus:ring-2">
                                            <div>
                                                <h5 class="font-semibold text-gray-900">
                                                    {{ $addOn->addOnName }}
                                                    <span class="ml-2 text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">ID: {{ $addOn->addOnID }}</span>
                                                </h5>
                                                <p class="text-sm text-orange-600 font-semibold">₱{{ number_format($addOn->price, 2) }}</p>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Booking Summary -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-4">
                            <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-6 border-2 border-orange-200">
                                <h3 class="font-bold text-xl text-gray-900 mb-4">Booking Summary</h3>
                                
                                <div class="space-y-3 mb-4">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Room Type:</span>
                                        <span class="font-semibold text-gray-900" id="summaryRoomType">-</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Number of Nights:</span>
                                        <span class="font-semibold text-gray-900" id="summaryNights">0</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Price per Night:</span>
                                        <span class="font-semibold text-gray-900" id="summaryPricePerNight">₱0.00</span>
                                    </div>
                                </div>

                                <div class="border-t-2 border-orange-300 pt-3 mb-3">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Room Subtotal:</span>
                                        <span class="font-semibold text-gray-900" id="summaryRoomSubtotal">₱0.00</span>
                                    </div>
                                </div>

                                <div id="addOnsSummary" class="space-y-2 mb-3 hidden">
                                    <p class="text-xs font-semibold text-gray-700 uppercase">Add-ons:</p>
                                </div>

                                <div class="border-t-2 border-orange-300 pt-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-bold text-gray-900">Total Amount:</span>
                                        <span class="text-2xl font-bold text-orange-600" id="summaryTotal">₱0.00</span>
                                    </div>
                                </div>

                                <input type="hidden" name="totalAmount" id="totalAmountInput" value="0">
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" 
                                class="w-full mt-4 bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-6 rounded-xl transition-all shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed"
                                id="submitBtn" disabled>
                                Confirm Booking
                            </button>
                            <a href="{{ route('customer.bookings.index') }}" 
                                class="block w-full mt-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-4 px-6 rounded-xl text-center transition-all">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const checkInInput = document.getElementById('checkInDate');
        const checkOutInput = document.getElementById('checkOutDate');
        const roomTypeRadios = document.querySelectorAll('.room-type-radio');
        const submitBtn = document.getElementById('submitBtn');
        const totalAmountInput = document.getElementById('totalAmountInput');

        let selectedRoomPrice = 0;
        let numberOfNights = 0;

        // Calculate nights
        function calculateNights() {
            const checkIn = new Date(checkInInput.value);
            const checkOut = new Date(checkOutInput.value);
            
            if (checkIn && checkOut && checkOut > checkIn) {
                const diffTime = Math.abs(checkOut - checkIn);
                numberOfNights = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                document.getElementById('nightsDisplay').textContent = `${numberOfNights} night(s)`;
                document.getElementById('summaryNights').textContent = numberOfNights;
            } else {
                numberOfNights = 0;
                document.getElementById('nightsDisplay').textContent = '';
                document.getElementById('summaryNights').textContent = '0';
            }
            
            updateSummary();
        }

        // Update check-out min date when check-in changes
        checkInInput.addEventListener('change', function() {
            const checkInDate = new Date(this.value);
            checkInDate.setDate(checkInDate.getDate() + 1);
            checkOutInput.min = checkInDate.toISOString().split('T')[0];
            
            if (checkOutInput.value && new Date(checkOutInput.value) <= new Date(this.value)) {
                checkOutInput.value = '';
            }
            
            calculateNights();
        });

        checkOutInput.addEventListener('change', calculateNights);

        // Room type selection
        roomTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                // Update visual selection
                document.querySelectorAll('.room-type-card').forEach(card => {
                    card.classList.remove('border-orange-500', 'bg-orange-50');
                    card.classList.add('border-gray-200');
                });
                
                if (this.checked) {
                    const card = this.closest('label').querySelector('.room-type-card');
                    card.classList.remove('border-gray-200');
                    card.classList.add('border-orange-500', 'bg-orange-50');
                    
                    selectedRoomPrice = parseFloat(this.dataset.price);
                    document.getElementById('summaryRoomType').textContent = this.dataset.typeName;
                    document.getElementById('summaryPricePerNight').textContent = '₱' + selectedRoomPrice.toFixed(2);
                    
                    // Show a sample Room ID based on room type
                    const roomTypeId = this.value;
                    let sampleRoomId = 'Auto-assigned';
                    if (roomTypeId == '3') sampleRoomId = 'LUX1-101'; // Luxury Room 1
                    else if (roomTypeId == '4') sampleRoomId = 'LUX2-201'; // Luxury Room 2  
                    else if (roomTypeId == '5') sampleRoomId = 'CAT-301'; // Cat Room
                    
                    document.getElementById('displayRoomID').value = sampleRoomId;
                }
                
                updateSummary();
            });
        });

        // Add-ons
        const addonCheckboxes = document.querySelectorAll('.addon-checkbox');
        addonCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSummary);
        });

        function updateSummary() {
            // Calculate room subtotal
            const roomSubtotal = selectedRoomPrice * numberOfNights;
            document.getElementById('summaryRoomSubtotal').textContent = '₱' + roomSubtotal.toFixed(2);
            
            // Calculate add-ons
            let addOnsTotal = 0;
            const addOnsSummaryDiv = document.getElementById('addOnsSummary');
            addOnsSummaryDiv.innerHTML = '<p class="text-xs font-semibold text-gray-700 uppercase">Add-ons:</p>';
            
            let hasAddOns = false;
            addonCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    hasAddOns = true;
                    const price = parseFloat(checkbox.dataset.price);
                    addOnsTotal += price;
                    
                    const addOnItem = document.createElement('div');
                    addOnItem.className = 'flex justify-between text-xs';
                    addOnItem.innerHTML = `
                        <span class="text-gray-600">${checkbox.dataset.name}</span>
                        <span class="font-semibold text-gray-900">₱${price.toFixed(2)}</span>
                    `;
                    addOnsSummaryDiv.appendChild(addOnItem);
                }
            });
            
            addOnsSummaryDiv.classList.toggle('hidden', !hasAddOns);
            
            // Calculate total
            const total = roomSubtotal + addOnsTotal;
            document.getElementById('summaryTotal').textContent = '₱' + total.toFixed(2);
            totalAmountInput.value = total.toFixed(2);
            
            // Enable/disable submit button
            const hasRoomType = Array.from(roomTypeRadios).some(r => r.checked);
            const hasDates = checkInInput.value && checkOutInput.value && numberOfNights > 0;
            const hasPet = document.getElementById('petID').value;
            
            submitBtn.disabled = !(hasRoomType && hasDates && hasPet && total > 0);
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Restore selected room type if any
            const checkedRadio = document.querySelector('.room-type-radio:checked');
            if (checkedRadio) {
                checkedRadio.dispatchEvent(new Event('change'));
            }
            
            calculateNights();
            updateSummary();
        });

        // Pet selection
        document.getElementById('petID').addEventListener('change', function() {
            const displayPetID = document.getElementById('displayPetID');
            if (this.value) {
                displayPetID.value = this.value;
            } else {
                displayPetID.value = '-';
            }
            updateSummary();
        });
    </script>
</x-customer-layout>
