<?php if (isset($component)) { $__componentOriginalfcad64dfa01b029ba835611407e96dec = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfcad64dfa01b029ba835611407e96dec = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.customer-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('customer-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="<?php echo e(route('customer.pets.index')); ?>" class="mr-4 text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="font-bold text-2xl text-gray-900">
                    Pet Details
                </h2>
            </div>
            <a href="<?php echo e(route('customer.pets.edit', $pet->petID)); ?>" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded inline-flex items-center text-sm">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Pet
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Pet Photo -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <?php if($pet->petPhoto): ?>
                        <img src="<?php echo e(asset('storage/' . $pet->petPhoto)); ?>" alt="<?php echo e($pet->petName); ?>" class="w-full h-80 object-cover">
                    <?php else: ?>
                        <div class="w-full h-80 bg-gray-100 flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-24 h-24 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-gray-400 text-sm font-medium">No photo uploaded</p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="p-6 border-t border-gray-100">
                        <div class="text-center">
                            <h3 class="text-2xl font-semibold text-gray-900 mb-1"><?php echo e($pet->petName); ?></h3>
                            <p class="text-gray-500 text-sm"><?php echo e($pet->breed); ?></p>
                            <div class="mt-3 inline-block px-3 py-1 text-xs font-medium rounded
                                <?php echo e($pet->petType === 'Dog' ? 'bg-blue-50 text-blue-700' : ($pet->petType === 'Cat' ? 'bg-purple-50 text-purple-700' : 'bg-gray-100 text-gray-700')); ?>">
                                <?php echo e($pet->petType); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Pet Details -->
            <div class="lg:col-span-2 space-y-5">
                <!-- Basic Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h4 class="text-base font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-100">Basic Information</h4>
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <p class="text-xs text-gray-500 mb-1 uppercase tracking-wide">Pet Type</p>
                            <p class="text-sm font-medium text-gray-900"><?php echo e($pet->petType); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1 uppercase tracking-wide">Breed</p>
                            <p class="text-sm font-medium text-gray-900"><?php echo e($pet->breed); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1 uppercase tracking-wide">Gender</p>
                            <p class="text-sm font-medium text-gray-900"><?php echo e($pet->gender); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1 uppercase tracking-wide">Size</p>
                            <p class="text-sm font-medium text-gray-900">
                                <?php if($pet->weightSize == 'S'): ?> Small
                                <?php elseif($pet->weightSize == 'M'): ?> Medium
                                <?php else: ?> Large
                                <?php endif; ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1 uppercase tracking-wide">Birthdate</p>
                            <p class="text-sm font-medium text-gray-900"><?php echo e($pet->birthdate->format('M d, Y')); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1 uppercase tracking-wide">Age</p>
                            <p class="text-sm font-medium text-gray-900"><?php echo e(\Carbon\Carbon::parse($pet->birthdate)->age); ?> years old</p>
                        </div>
                    </div>
                </div>

                <!-- Vaccination Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h4 class="text-base font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-100">Vaccination Records</h4>
                    <?php if($pet->vaccinationFile): ?>
                        <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-green-800 text-sm">Vaccination File Uploaded</p>
                                    <p class="text-xs text-green-600">Click to view or download</p>
                                </div>
                            </div>
                            <a href="<?php echo e(asset('storage/' . $pet->vaccinationFile)); ?>" target="_blank" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded text-sm inline-flex items-center transition-all">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View File
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="flex items-center p-4 bg-amber-50 border border-amber-200 rounded">
                            <div class="w-10 h-10 bg-amber-100 rounded flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-amber-800 text-sm">No Vaccination File</p>
                                <p class="text-xs text-amber-600">Please upload vaccination records</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Booking History -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h4 class="text-base font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-100">Booking History</h4>
                    <?php if($pet->bookings->count() > 0): ?>
                        <div class="space-y-2">
                            <?php $__currentLoopData = $pet->bookings->sortByDesc('bookingID')->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded hover:bg-gray-100 transition-all">
                                    <div>
                                        <p class="font-medium text-gray-900 text-sm">Room <?php echo e($booking->room->roomNum); ?></p>
                                        <p class="text-xs text-gray-500"><?php echo e($booking->checkInDate->format('M d')); ?> - <?php echo e($booking->checkOutDate->format('M d, Y')); ?></p>
                                    </div>
                                    <span class="px-2.5 py-1 text-xs font-medium rounded
                                        <?php if($booking->status == 'Confirmed'): ?> bg-green-100 text-green-800
                                        <?php elseif($booking->status == 'Pending'): ?> bg-amber-100 text-amber-800
                                        <?php elseif($booking->status == 'Completed'): ?> bg-blue-100 text-blue-800
                                        <?php else: ?> bg-red-100 text-red-800
                                        <?php endif; ?>">
                                        <?php echo e($booking->status); ?>

                                    </span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm">No bookings yet</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Actions -->
                <div class="flex gap-3">
                    <a href="<?php echo e(route('customer.pets.edit', $pet->petID)); ?>" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center py-2.5 px-5 rounded font-medium transition-all">
                        Edit Pet Details
                    </a>
                    <form method="POST" action="<?php echo e(route('customer.pets.destroy', $pet->petID)); ?>" class="flex-1" onsubmit="return confirm('Are you sure you want to delete <?php echo e($pet->petName); ?>?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-2.5 px-5 rounded font-medium transition-all">
                            Delete Pet
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfcad64dfa01b029ba835611407e96dec)): ?>
<?php $attributes = $__attributesOriginalfcad64dfa01b029ba835611407e96dec; ?>
<?php unset($__attributesOriginalfcad64dfa01b029ba835611407e96dec); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfcad64dfa01b029ba835611407e96dec)): ?>
<?php $component = $__componentOriginalfcad64dfa01b029ba835611407e96dec; ?>
<?php unset($__componentOriginalfcad64dfa01b029ba835611407e96dec); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Administrator\Downloads\PETHOTELFORIT6-main\resources\views/pets/show.blade.php ENDPATH**/ ?>