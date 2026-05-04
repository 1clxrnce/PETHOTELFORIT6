<?php if (isset($component)) { $__componentOriginale0f1cdd055772eb1d4a99981c240763e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0f1cdd055772eb1d4a99981c240763e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create New Booking
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="<?php echo e(route('bookings.store')); ?>" method="POST" id="bookingForm">
                        <?php echo csrf_field(); ?>
                        
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
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['cusID'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <option value="">Select Customer</option>
                                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($customer->cusID); ?>" <?php echo e(old('cusID') == $customer->cusID ? 'selected' : ''); ?>>
                                                        <?php echo e($customer->cusFName); ?> <?php echo e($customer->cusLName); ?> (ID: <?php echo e($customer->cusID); ?>)
                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['cusID'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                            Pet <span class="text-red-500">*</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <select name="petID" id="petID" required 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['petID'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <option value="">Select Pet</option>
                                                <?php $__currentLoopData = $pets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($pet->petID); ?>" data-customer="<?php echo e($pet->cusID); ?>" <?php echo e(old('petID') == $pet->petID ? 'selected' : ''); ?>>
                                                        <?php echo e($pet->petName); ?> (<?php echo e($pet->petType); ?> - <?php echo e($pet->weightSize); ?>) - Owner: <?php echo e($pet->customer->cusFName); ?> <?php echo e($pet->customer->cusLName); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['petID'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                            Room <span class="text-red-500">*</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <select name="roomID" id="roomID" required 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['roomID'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <option value="">Select Room</option>
                                                <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($room->roomID); ?>" 
                                                            data-price="<?php echo e($room->roomType->pricePerNight); ?>"
                                                            data-capacity="<?php echo e($room->roomType->maxCapacity); ?>"
                                                            data-available="<?php echo e($room->getAvailableSpots()); ?>"
                                                            <?php echo e(old('roomID') == $room->roomID ? 'selected' : ''); ?>>
                                                        <?php echo e($room->roomNumber); ?> - <?php echo e($room->roomType->typeName); ?> 
                                                        (₱<?php echo e(number_format($room->roomType->pricePerNight, 2)); ?>/night, 
                                                        <?php echo e($room->getAvailableSpots()); ?>/<?php echo e($room->roomType->maxCapacity); ?> spots available)
                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['roomID'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                            Check-in Date <span class="text-red-500">*</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <input type="date" name="checkInDate" id="checkInDate" value="<?php echo e(old('checkInDate')); ?>" required 
                                                   min="<?php echo e(date('Y-m-d')); ?>"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['checkInDate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <?php $__errorArgs = ['checkInDate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                            Check-out Date <span class="text-red-500">*</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <input type="date" name="checkOutDate" id="checkOutDate" value="<?php echo e(old('checkOutDate')); ?>" required 
                                                   min="<?php echo e(date('Y-m-d', strtotime('+1 day'))); ?>"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['checkOutDate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <?php $__errorArgs = ['checkOutDate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                                <input type="number" name="totalAmount" id="totalAmount" value="<?php echo e(old('totalAmount')); ?>" step="0.01" min="0" required readonly
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-500 <?php $__errorArgs = ['totalAmount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            </div>
                                            <?php $__errorArgs = ['totalAmount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                <?php $__currentLoopData = $addOns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addOn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="flex items-center p-4 border border-gray-300 rounded-lg hover:border-blue-500 cursor-pointer">
                                        <input type="checkbox" 
                                               name="addOns[<?php echo e($addOn->addOnID); ?>]" 
                                               value="1"
                                               data-price="<?php echo e($addOn->price); ?>"
                                               data-name="<?php echo e($addOn->addOnName); ?>"
                                               class="addon-checkbox mr-3 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <div>
                                            <div class="font-medium text-gray-900"><?php echo e($addOn->addOnName); ?></div>
                                            <div class="text-sm text-blue-600 font-semibold">₱<?php echo e(number_format($addOn->price, 2)); ?></div>
                                        </div>
                                    </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            <a href="<?php echo e(route('bookings.index')); ?>" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0f1cdd055772eb1d4a99981c240763e)): ?>
<?php $attributes = $__attributesOriginale0f1cdd055772eb1d4a99981c240763e; ?>
<?php unset($__attributesOriginale0f1cdd055772eb1d4a99981c240763e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0f1cdd055772eb1d4a99981c240763e)): ?>
<?php $component = $__componentOriginale0f1cdd055772eb1d4a99981c240763e; ?>
<?php unset($__componentOriginale0f1cdd055772eb1d4a99981c240763e); ?>
<?php endif; ?><?php /**PATH C:\Users\Administrator\Downloads\PETHOTELFORIT6-main\resources\views/bookings/create.blade.php ENDPATH**/ ?>