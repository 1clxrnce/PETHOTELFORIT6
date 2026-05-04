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
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="mb-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="<?php echo e(route('rooms.index')); ?>" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900">Room <?php echo e($room->roomNum); ?></h1>
                </div>
                <a href="<?php echo e(route('rooms.edit', $room->roomID)); ?>"
                   class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium flex items-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Room
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Photo -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <?php if($room->roomPhoto): ?>
                            <img src="<?php echo e(asset('storage/' . $room->roomPhoto)); ?>" alt="Room <?php echo e($room->roomNum); ?>" class="w-full h-64 object-cover">
                        <?php else: ?>
                            <div class="w-full h-64 bg-gray-100 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    <p class="text-gray-400 text-sm">No photo uploaded</p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="p-5 border-t border-gray-100 text-center">
                            <h3 class="text-xl font-semibold text-gray-900">Room <?php echo e($room->roomNum); ?></h3>
                            <p class="text-gray-500 text-sm mt-1"><?php echo e($room->roomType->typeName ?? 'N/A'); ?></p>
                            <?php $occupancyStatus = $room->getOccupancyStatus(); ?>
                            <span class="mt-2 inline-block px-3 py-1 text-xs font-medium rounded
                                <?php if($occupancyStatus === 'Available'): ?> bg-green-100 text-green-700
                                <?php elseif($occupancyStatus === 'Full'): ?> bg-red-100 text-red-700
                                <?php else: ?> bg-yellow-100 text-yellow-700
                                <?php endif; ?>">
                                <?php echo e($room->status === 'Maintenance' ? 'Maintenance' : $occupancyStatus); ?>

                            </span>
                        </div>
                    </div>
                </div>

                <!-- Details -->
                <div class="lg:col-span-2 space-y-5">
                    <!-- Room Info -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h4 class="text-base font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-100">Room Information</h4>
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Room ID</p>
                                <p class="text-sm font-medium text-gray-900">#<?php echo e($room->roomID); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Room Number</p>
                                <p class="text-sm font-medium text-gray-900"><?php echo e($room->roomNum); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Room Type</p>
                                <p class="text-sm font-medium text-gray-900"><?php echo e($room->roomType->typeName ?? 'N/A'); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Price / Night</p>
                                <p class="text-sm font-medium text-gray-900">₱<?php echo e(number_format($room->roomType->pricePerNight ?? 0, 2)); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Max Capacity</p>
                                <p class="text-sm font-medium text-gray-900"><?php echo e($room->roomType->maxCapacity ?? 0); ?> pets</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Current Occupancy</p>
                                <?php
                                    $current = $room->getCurrentOccupancy();
                                    $max = $room->roomType->maxCapacity ?? 0;
                                ?>
                                <p class="text-sm font-medium text-gray-900"><?php echo e($current); ?> / <?php echo e($max); ?> pets</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Description</p>
                                <p class="text-sm font-medium text-gray-900"><?php echo e($room->roomType->description ?? '—'); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Current Occupants -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h4 class="text-base font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-100">Current Occupants</h4>
                        <?php
                            $currentBookings = $room->bookings->whereIn('status', ['Confirmed', 'Checked In'])
                                ->where('checkInDate', '<=', now())
                                ->where('checkOutDate', '>=', now());
                        ?>
                        <?php if($currentBookings->count() > 0): ?>
                            <div class="space-y-3">
                                <?php $__currentLoopData = $currentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-center gap-4 p-3 bg-blue-50 border border-blue-100 rounded-lg">
                                        <?php if($booking->pet->petPhoto): ?>
                                            <img src="<?php echo e(asset('storage/' . $booking->pet->petPhoto)); ?>"
                                                 alt="<?php echo e($booking->pet->petName); ?>"
                                                 class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm shrink-0">
                                        <?php else: ?>
                                            <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center shrink-0">
                                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-900 text-sm"><?php echo e($booking->pet->petName); ?></p>
                                            <p class="text-xs text-gray-500"><?php echo e($booking->pet->breed); ?> · <?php echo e($booking->pet->petType); ?></p>
                                            <p class="text-xs text-gray-500 mt-0.5">
                                                Owner: <?php echo e($booking->customer->cusFName); ?> <?php echo e($booking->customer->cusLName); ?>

                                            </p>
                                        </div>
                                        <div class="text-right shrink-0">
                                            <p class="text-xs font-medium text-blue-700">Check-out</p>
                                            <p class="text-xs text-gray-600"><?php echo e($booking->checkOutDate->format('M d, Y')); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-6 text-gray-400">
                                <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                </svg>
                                <p class="text-sm">No pets currently in this room</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Booking History -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h4 class="text-base font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-100">Booking History</h4>
                        <?php if($room->bookings->count() > 0): ?>
                            <div class="space-y-2">
                                <?php $__currentLoopData = $room->bookings->sortByDesc('bookingID'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div>
                                            <p class="font-medium text-gray-900 text-sm">Booking #<?php echo e($booking->bookingID); ?></p>
                                            <p class="text-xs text-gray-500"><?php echo e($booking->checkInDate->format('M d')); ?> – <?php echo e($booking->checkOutDate->format('M d, Y')); ?></p>
                                        </div>
                                        <span class="px-2.5 py-1 text-xs font-medium rounded
                                            <?php if($booking->status == 'Confirmed'): ?> bg-green-100 text-green-800
                                            <?php elseif($booking->status == 'Pending'): ?> bg-amber-100 text-amber-800
                                            <?php elseif($booking->status == 'Checked Out'): ?> bg-blue-100 text-blue-800
                                            <?php else: ?> bg-red-100 text-red-800
                                            <?php endif; ?>">
                                            <?php echo e($booking->status); ?>

                                        </span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-8 text-gray-400">
                                <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm">No bookings yet</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3">
                        <a href="<?php echo e(route('rooms.edit', $room->roomID)); ?>"
                           class="flex-1 text-center py-2.5 px-5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-all">
                            Edit Room
                        </a>
                        <form method="POST" action="<?php echo e(route('rooms.destroy', $room->roomID)); ?>" class="flex-1"
                              onsubmit="return confirm('Delete Room <?php echo e($room->roomNum); ?>?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="w-full py-2.5 px-5 bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition-all">
                                Delete Room
                            </button>
                        </form>
                    </div>
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
<?php endif; ?>
<?php /**PATH C:\Users\Administrator\Downloads\PETHOTELFORIT6-main\resources\views/rooms/show.blade.php ENDPATH**/ ?>