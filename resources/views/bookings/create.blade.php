<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create New Booking
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm">
                        @csrf
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50 w-1/3">
                                            Booking ID
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <input type="text" value="Auto-assigned" disabled class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-500">
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                            Customer <span class="text-red-500">*</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <select name="cusID" id="cusID" required 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('cusID') border-red-500 @enderror">
                                                <option value="">Select Customer</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->cusID }}" {{ old('cusID') == $customer->cusID ? 'selected' : '' }}>
                                                        {{ $customer->cusFName }} {{ $customer->cusLName }} (ID: {{ $customer->cusID }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('cusID')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                            Pet <span class="text-red-500">*</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <select name="petID" id="petID" required 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('petID') border-red-500 @enderror">
                                                <option value="">Select Pet</option>
                                                @foreach($pets as $pet)
                                                    <option value="{{ $pet->petID }}" data-customer="{{ $pet->cusID }}" {{ old('petID') == $pet->petID ? 'selected' : '' }}>
                                                        {{ $pet->petName }} ({{ $pet->petType }} - {{ $pet->weightSize }}) - Owner: {{ $pet->customer->cusFName }} {{ $pet->customer->cusLName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('petID')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                            Room <span class="text-red-500">*</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <select name="roomID" id="roomID" required 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('roomID') border-red-500 @enderror">
                                                <option value="">Select Room</option>
                                                @foreach($rooms as $room)
                                                    <option value="{{ $room->roomID }}" 
                                                            data-price="{{ $room->roomType->pricePerNight }}"
                                                            data-capacity="{{ $room->roomType->maxCapacity }}"
                                                            data-available="{{ $room->getAvailableSpots() }}"
                                                            {{ old('roomID') == $room->roomID ? 'selected' : '' }}>
                                                        {{ $room->roomNumber }} - {{ $room->roomType->typeName }} 
                                                        (₱{{ number_format($room->roomType->pricePerNight, 2) }}/night, 
                                                        {{ $room->getAvailableSpots() }}/{{ $room->roomType->maxCapacity }} spots available)
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('roomID')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                            Check-in Date <span class="text-red-500">*</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <input type="date" name="checkInDate" id="checkInDate" value="{{ old('checkInDate') }}" required 
                                                   min="{{ date('Y-m-d') }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('checkInDate') border-red-500 @enderror">
                                            @error('checkInDate')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                            Check-out Date <span class="text-red-500">*</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <input type="date" name="checkOutDate" id="checkOutDate" value="{{ old('checkOutDate') }}" required 
                                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('checkOutDate') border-red-500 @enderror">
                                            @error('checkOutDate')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                            <p class="text-sm text-gray-500 mt-1" id="nightsDisplay"></p>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                            Total Amount <span class="text-red-500">*</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="flex items-center">
                                                <span class="text-gray-500 mr-2">₱</span>
                                                <input type="number" name="totalAmount" id="totalAmount" value="{{ old('totalAmount') }}" step="0.01" min="0" required readonly
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-500 @error('totalAmount') border-red-500 @enderror">
                                            </div>
                                            @error('totalAmount')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                            <p class="text-sm text-gray-500 mt-1">Amount will be calculated automatically</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Add-ons Section -->
                        <div class="mt-6 border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold mb-4">Add-ons (Optional)</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($addOns as $addOn)
                                    <label class="flex items-center p-4 border border-gray-300 rounded-lg hover:border-blue-500 cursor-pointer">
                                        <input type="checkbox" 
                                               name="addOns[{{ $addOn->addOnID }}]" 
                                               value="1"
                                               data-price="{{ $addOn->price }}"
                                               data-name="{{ $addOn->addOnName }}"
                                               class="addon-checkbox mr-3 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $addOn->addOnName }}</div>
                                            <div class="text-sm text-blue-600 font-semibold">₱{{ number_format($addOn->price, 2) }}</div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Booking Summary -->
                        <div class="mt-6 border-t border-gray-200 pt-6">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="text-lg font-semibold mb-3">Booking Summary</h3>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span>Room Rate:</span>
                                        <span id="summaryRoomRate">₱0.00 per night</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Number of Nights:</span>
                                        <span id="summaryNights">0</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Room Subtotal:</span>
                                        <span id="summaryRoomSubtotal">₱0.00</span>
                                    </div>
                                    <div id="addOnsSummary" class="hidden">
                                        <div class="border-t border-gray-300 pt-2 mt-2">
                                            <div class="font-medium mb-1">Add-ons:</div>
                                            <div id="addOnsDetails"></div>
                                        </div>
                                    </div>
                                    <div class="border-t border-gray-300 pt-2 mt-2 flex justify-between font-semibold text-lg">
                                        <span>Total Amount:</span>
                                        <span id="summaryTotal">₱0.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4 mt-6 pt-6 border-t border-gray-200">
                            <a href="{{ route('bookings.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                                Back
                            </a>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                                Create Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const checkInInput = document.getElementById('checkInDate');
        const checkOutInput = document.getElementById('checkOutDate');
        const roomSelect = document.getElementById('roomID');
        const totalAmountInput = document.getElementById('totalAmount');
        const cusIDSelect = document.getElementById('cusID');
        const petIDSelect = document.getElementById('petID');

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

        // Room selection
        roomSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                selectedRoomPrice = parseFloat(selectedOption.dataset.price);
                document.getElementById('summaryRoomRate').textContent = '₱' + selectedRoomPrice.toFixed(2) + ' per night';
            } else {
                selectedRoomPrice = 0;
                document.getElementById('summaryRoomRate').textContent = '₱0.00 per night';
            }
            updateSummary();
        });

        // Customer selection filters pets
        cusIDSelect.addEventListener('change', function() {
            const selectedCustomerID = this.value;
            const petOptions = petIDSelect.querySelectorAll('option');
            
            // Reset pet selection
            petIDSelect.value = '';
            
            // Show/hide pet options based on selected customer
            petOptions.forEach(option => {
                if (option.value === '') {
                    option.style.display = 'block'; // Always show "Select Pet" option
                } else {
                    const petCustomerID = option.dataset.customer;
                    option.style.display = (selectedCustomerID === '' || petCustomerID === selectedCustomerID) ? 'block' : 'none';
                }
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
            const addOnsDetailsDiv = document.getElementById('addOnsDetails');
            const addOnsSummaryDiv = document.getElementById('addOnsSummary');
            addOnsDetailsDiv.innerHTML = '';
            
            let hasAddOns = false;
            addonCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    hasAddOns = true;
                    const price = parseFloat(checkbox.dataset.price);
                    addOnsTotal += price;
                    
                    const addOnItem = document.createElement('div');
                    addOnItem.className = 'flex justify-between text-sm';
                    addOnItem.innerHTML = `
                        <span>${checkbox.dataset.name}</span>
                        <span>₱${price.toFixed(2)}</span>
                    `;
                    addOnsDetailsDiv.appendChild(addOnItem);
                }
            });
            
            addOnsSummaryDiv.classList.toggle('hidden', !hasAddOns);
            
            // Calculate total
            const total = roomSubtotal + addOnsTotal;
            document.getElementById('summaryTotal').textContent = '₱' + total.toFixed(2);
            totalAmountInput.value = total.toFixed(2);
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            calculateNights();
            updateSummary();
        });
    </script>
</x-admin-layout>