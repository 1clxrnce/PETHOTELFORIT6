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
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900">
                    Booking Details #<?php echo e($booking->bookingID); ?>

                </h2>
                <p class="text-gray-600 mt-1">Complete booking information and management</p>
            </div>
            <a href="<?php echo e(route('bookings.index')); ?>" 
                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-semibold transition-all">
                ← Back to Bookings
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <!-- Status Banner -->
            <div class="mb-8">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Booking Status</h3>
                            <?php
                                $statusConfig = [
                                    'Pending' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800'],
                                    'Confirmed' => ['bg' => 'bg-green-100', 'text' => 'text-green-800'],
                                    'Completed' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800'],
                                    'Cancelled' => ['bg' => 'bg-red-100', 'text' => 'text-red-800']
                                ];
                                $config = $statusConfig[$booking->status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800'];
                            ?>
                            <span class="inline-flex items-center px-4 py-2 text-lg font-semibold rounded-full <?php echo e($config['bg']); ?> <?php echo e($config['text']); ?>">
                                <?php echo e($booking->status); ?>

                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-3">
                            <?php if($booking->status === 'Pending'): ?>
                                <form method="POST" action="<?php echo e(route('bookings.verify', $booking->bookingID)); ?>" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <input type="hidden" name="status" value="Confirmed">
                                    <button type="submit" 
                                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition-all shadow-lg hover:shadow-xl"
                                        onclick="return confirm('Confirm this booking?')">
                                        Confirm Booking
                                    </button>
                                </form>
                                <form method="POST" action="<?php echo e(route('bookings.verify', $booking->bookingID)); ?>" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <input type="hidden" name="status" value="Cancelled">
                                    <button type="submit" 
                                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition-all shadow-lg hover:shadow-xl"
                                        onclick="return confirm('Cancel this booking?')">
                                        Cancel Booking
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="xl:col-span-2 space-y-8">
                    <!-- Customer & Pet Information -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Customer Information -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                                <h3 class="text-lg font-bold text-gray-900">
                                    Customer Information
                                </h3>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Customer ID</label>
                                    <p class="text-lg font-medium text-blue-600">#<?php echo e($booking->customer->cusID); ?></p>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Full Name</label>
                                    <p class="text-lg font-medium text-gray-900">
                                        <?php echo e($booking->customer->cusFName); ?> 
                                        <?php if($booking->customer->cusMName): ?>
                                            <?php echo e($booking->customer->cusMName); ?> 
                                        <?php endif; ?>
                                        <?php echo e($booking->customer->cusLName); ?>

                                    </p>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">User ID</label>
                                    <p class="text-gray-900"><?php echo e($booking->customer->userID); ?></p>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Username</label>
                                    <p class="text-gray-900"><?php echo e($booking->customer->user->username ?? 'Not available'); ?></p>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Email Address</label>
                                    <p class="text-gray-900"><?php echo e($booking->customer->email ?: 'Not provided'); ?></p>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Phone Number</label>
                                    <p class="text-gray-900"><?php echo e($booking->customer->phoneNum ?: 'Not provided'); ?></p>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Address</label>
                                    <p class="text-gray-900"><?php echo e($booking->customer->address ?: 'Not provided'); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Pet Information -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                                <h3 class="text-lg font-bold text-gray-900">
                                    Pet Information
                                </h3>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Pet ID</label>
                                    <p class="text-lg font-medium text-blue-600">#<?php echo e($booking->pet->petID); ?></p>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Pet Name</label>
                                    <p class="text-lg font-medium text-gray-900"><?php echo e($booking->pet->petName); ?></p>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Type</label>
                                        <p class="text-gray-900"><?php echo e($booking->pet->petType ?: 'Not specified'); ?></p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Breed</label>
                                        <p class="text-gray-900"><?php echo e($booking->pet->breed ?: 'Not specified'); ?></p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Gender</label>
                                        <p class="text-gray-900"><?php echo e($booking->pet->gender ?: 'Not specified'); ?></p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Weight Size</label>
                                        <p class="text-gray-900"><?php echo e($booking->pet->weightSize ?: 'Not specified'); ?></p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Birthdate</label>
                                        <p class="text-gray-900">
                                            <?php if($booking->pet->birthdate): ?>
                                                <?php echo e(\Carbon\Carbon::parse($booking->pet->birthdate)->format('M d, Y')); ?>

                                            <?php else: ?>
                                                Not specified
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Age</label>
                                        <p class="text-gray-900">
                                            <?php if($booking->pet->birthdate): ?>
                                                <?php echo e(\Carbon\Carbon::parse($booking->pet->birthdate)->age); ?> years old
                                            <?php else: ?>
                                                Not specified
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                                <?php if($booking->pet->petPhoto): ?>
                                <div>
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Pet Photo</label>
                                    <div class="mt-2">
                                        <img src="<?php echo e(asset('storage/' . $booking->pet->petPhoto)); ?>" 
                                             alt="<?php echo e($booking->pet->petName); ?>" 
                                             class="w-24 h-24 rounded-lg object-cover border border-gray-200">
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($booking->pet->vaccinationFile): ?>
                                <div>
                                    <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Vaccination Records</label>
                                    <p class="text-gray-900 bg-blue-50 border border-blue-200 rounded-lg p-3 mt-2">
                                        <a href="<?php echo e(asset('storage/' . $booking->pet->vaccinationFile)); ?>" target="_blank" class="text-blue-600 hover:text-blue-800 flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            View Vaccination Records
                                        </a>
                                    </p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Room Information -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                            <h3 class="text-lg font-bold text-gray-900">
                                Room Details
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                <div class="bg-gray-50 rounded-lg p-4 text-center">
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                        <span class="text-xl font-bold text-blue-600"><?php echo e($booking->room->roomNum); ?></span>
                                    </div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide block mb-1">Room Number</label>
                                    <p class="text-sm font-medium text-gray-900">Room <?php echo e($booking->room->roomNum); ?></p>
                                </div>
                                
                                <div class="bg-gray-50 rounded-lg p-4 text-center">
                                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                        <span class="text-sm font-bold text-purple-600">TYPE</span>
                                    </div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide block mb-1">Room Type</label>
                                    <p class="text-sm font-medium text-gray-900"><?php echo e($booking->room->roomType->typeName); ?></p>
                                </div>
                                
                                <div class="bg-gray-50 rounded-lg p-4 text-center">
                                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                        <span class="text-sm font-bold text-green-600">₱</span>
                                    </div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide block mb-1">Rate per Night</label>
                                    <p class="text-sm font-medium text-gray-900">₱<?php echo e(number_format($booking->room->roomType->pricePerNight, 2)); ?></p>
                                </div>
                                
                                <div class="bg-gray-50 rounded-lg p-4 text-center">
                                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                        <span class="text-sm font-bold text-orange-600">MAX</span>
                                    </div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide block mb-1">Max Capacity</label>
                                    <p class="text-sm font-medium text-gray-900"><?php echo e($booking->room->roomType->maxCapacity); ?> pets</p>
                                </div>
                            </div>
                            
                            <!-- Additional Room Information -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Room ID</label>
                                        <p class="text-gray-900 mt-1 font-medium">#<?php echo e($booking->room->roomID); ?></p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Room Status</label>
                                        <p class="text-gray-900 mt-1">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                                <?php echo e($booking->room->status === 'Available' ? 'bg-green-100 text-green-800' : ''); ?>

                                                <?php echo e($booking->room->status === 'Occupied' ? 'bg-blue-100 text-blue-800' : ''); ?>

                                                <?php echo e($booking->room->status === 'Maintenance' ? 'bg-red-100 text-red-800' : ''); ?>">
                                                <?php echo e($booking->room->status); ?>

                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Current Occupancy</label>
                                        <p class="text-gray-900 mt-1"><?php echo e($booking->room->getCurrentOccupancy()); ?>/<?php echo e($booking->room->roomType->maxCapacity); ?> pets</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add-ons -->
                    <?php if($booking->addOns->count() > 0): ?>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                            <h3 class="text-lg font-bold text-gray-900">
                                Add-on Services
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <?php $__currentLoopData = $booking->addOns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addOn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <h4 class="font-semibold text-gray-900"><?php echo e($addOn->addOnName); ?></h4>
                                                <p class="text-sm text-gray-600">Quantity: <?php echo e($addOn->pivot->quantity); ?></p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-lg font-bold text-gray-900">₱<?php echo e(number_format($addOn->price * $addOn->pivot->quantity, 2)); ?></p>
                                                <p class="text-sm text-gray-500">₱<?php echo e(number_format($addOn->price, 2)); ?> each</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Booking Summary -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-blue-50 border-b border-blue-200 px-6 py-4">
                            <h3 class="text-lg font-bold text-blue-900">
                                Booking Summary
                            </h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Booking ID</span>
                                <span class="font-bold text-blue-600">#<?php echo e($booking->bookingID); ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Customer ID</span>
                                <span class="font-medium">#<?php echo e($booking->customer->cusID); ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Pet ID</span>
                                <span class="font-medium">#<?php echo e($booking->pet->petID); ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Room ID</span>
                                <span class="font-medium">#<?php echo e($booking->room->roomID); ?></span>
                            </div>
                            <?php if($booking->empID): ?>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Employee ID</span>
                                <span class="font-medium">#<?php echo e($booking->empID); ?></span>
                            </div>
                            <?php endif; ?>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Check-in Date</span>
                                <span class="font-medium"><?php echo e(\Carbon\Carbon::parse($booking->checkInDate)->format('M d, Y')); ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Check-out Date</span>
                                <span class="font-medium"><?php echo e(\Carbon\Carbon::parse($booking->checkOutDate)->format('M d, Y')); ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Duration</span>
                                <span class="font-medium"><?php echo e(\Carbon\Carbon::parse($booking->checkInDate)->diffInDays(\Carbon\Carbon::parse($booking->checkOutDate))); ?> nights</span>
                            </div>
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-xl font-bold text-gray-900">Total Amount</span>
                                    <span class="text-2xl font-bold text-blue-600">₱<?php echo e(number_format($booking->totalAmount, 2)); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Status -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-blue-50 border-b border-blue-200 px-6 py-4">
                            <h3 class="text-lg font-bold text-blue-900">
                                Payment Status
                            </h3>
                        </div>
                        <div class="p-6">
                            <?php
                                $totalPaid = $booking->getTotalPaid();
                                $remainingBalance = $booking->getRemainingBalance();
                                $paymentProgress = $booking->getPaymentProgress();
                            ?>
                            
                            <!-- Payment Progress Bar -->
                            <div class="mb-4">
                                <div class="flex justify-between text-sm font-medium text-gray-700 mb-2">
                                    <span>Payment Progress</span>
                                    <span><?php echo e(number_format($paymentProgress, 1)); ?>%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-green-400 to-green-600 h-3 rounded-full transition-all duration-300" 
                                         style="width: <?php echo e($paymentProgress); ?>%"></div>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Total Amount</span>
                                    <span class="font-bold">₱<?php echo e(number_format($booking->totalAmount, 2)); ?></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Amount Paid</span>
                                    <span class="font-bold text-green-600">₱<?php echo e(number_format($totalPaid, 2)); ?></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Remaining Balance</span>
                                    <span class="font-bold text-red-600">₱<?php echo e(number_format($remainingBalance, 2)); ?></span>
                                </div>
                            </div>

                            <?php if($remainingBalance > 0): ?>
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <a href="<?php echo e(route('payments.createForBooking', $booking->bookingID)); ?>" 
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg text-center font-semibold transition-all shadow-lg hover:shadow-xl block">
                                        Add Payment
                                    </a>
                                </div>
                            <?php else: ?>
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <div class="bg-green-100 border border-green-300 rounded-lg p-3 text-center">
                                        <span class="text-green-800 font-semibold">Fully Paid</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Payment History -->
                    <?php if($booking->payments->count() > 0): ?>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                            <h3 class="text-lg font-bold text-gray-900">
                                Payment History
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                <?php $__currentLoopData = $booking->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="font-medium">₱<?php echo e(number_format($payment->amount, 2)); ?></span>
                                            <span class="text-xs px-2 py-1 rounded-full
                                                <?php echo e($payment->paymentStatus === 'Payment Complete' ? 'bg-green-100 text-green-700' : ''); ?>

                                                <?php echo e($payment->paymentStatus === 'Partially Paid' ? 'bg-yellow-100 text-yellow-700' : ''); ?>

                                                <?php echo e($payment->paymentStatus === 'Unpaid' ? 'bg-red-100 text-red-700' : ''); ?>">
                                                <?php echo e($payment->paymentStatus); ?>

                                            </span>
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            <p><?php echo e($payment->paymentMethod); ?> • <?php echo e(\Carbon\Carbon::parse($payment->paymentDate)->format('M d, Y')); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0f1cdd055772eb1d4a99981c240763e)): ?>
<?php $attributes = $__attributesOriginale0f1cdd055772eb1d4a99981c240763e; ?>
<?php unset($__attributesOriginale0f1cdd055772eb1d4a99981c240763e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0f1cdd055772eb1d4a99981c240763e)): ?>
<?php $component = $__componentOriginale0f1cdd055772eb1d4a99981c240763e; ?>
<?php unset($__componentOriginale0f1cdd055772eb1d4a99981c240763e); ?>
<?php endif; ?><?php /**PATH C:\Users\Administrator\Downloads\PETHOTELFORIT6-main\resources\views/bookings/show.blade.php ENDPATH**/ ?>