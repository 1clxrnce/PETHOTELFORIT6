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
                    <a href="<?php echo e(route('pets.index')); ?>" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900">Pet Details</h1>
                </div>
                <a href="<?php echo e(route('pets.edit', $pet->petID)); ?>"
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
                        <?php if($pet->petPhoto): ?>
                            <img src="<?php echo e(asset('storage/' . $pet->petPhoto)); ?>" alt="<?php echo e($pet->petName); ?>" class="w-full h-72 object-cover">
                        <?php else: ?>
                            <div class="w-full h-72 bg-gray-100 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-20 h-20 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-gray-400 text-sm">No photo uploaded</p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="p-5 border-t border-gray-100 text-center">
                            <h3 class="text-xl font-semibold text-gray-900"><?php echo e($pet->petName); ?></h3>
                            <p class="text-gray-500 text-sm mt-1"><?php echo e($pet->breed); ?></p>
                            <span class="mt-2 inline-block px-3 py-1 text-xs font-medium rounded
                                <?php echo e($pet->petType === 'Dog' ? 'bg-blue-50 text-blue-700' : 'bg-purple-50 text-purple-700'); ?>">
                                <?php echo e($pet->petType); ?>

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
                                    <?php echo e($pet->customer->cusFName); ?> <?php echo e($pet->customer->cusLName); ?>

                                    <span class="text-gray-400">(#<?php echo e($pet->cusID); ?>)</span>
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Pet ID</p>
                                <p class="text-sm font-medium text-gray-900">#<?php echo e($pet->petID); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Pet Type</p>
                                <p class="text-sm font-medium text-gray-900"><?php echo e($pet->petType); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Breed</p>
                                <p class="text-sm font-medium text-gray-900"><?php echo e($pet->breed); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Gender</p>
                                <p class="text-sm font-medium text-gray-900"><?php echo e($pet->gender); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Size</p>
                                <p class="text-sm font-medium text-gray-900">
                                    <?php if($pet->weightSize == 'S'): ?> Small
                                    <?php elseif($pet->weightSize == 'M'): ?> Medium
                                    <?php else: ?> Large
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Birthdate</p>
                                <p class="text-sm font-medium text-gray-900"><?php echo e($pet->birthdate->format('M d, Y')); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Age</p>
                                <p class="text-sm font-medium text-gray-900"><?php echo e(\Carbon\Carbon::parse($pet->birthdate)->age); ?> years old</p>
                            </div>
                        </div>
                    </div>

                    <!-- Vaccination -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h4 class="text-base font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-100">Vaccination Records</h4>
                        <?php if($pet->vaccinationFile): ?>
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
                                <a href="<?php echo e(asset('storage/' . $pet->vaccinationFile)); ?>" target="_blank"
                                   class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg">
                                    View File
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="p-4 bg-amber-50 border border-amber-200 rounded-lg text-sm text-amber-800">
                                No vaccination file uploaded.
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Booking History -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h4 class="text-base font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-100">Booking History</h4>
                        <?php if($pet->bookings->count() > 0): ?>
                            <div class="space-y-2">
                                <?php $__currentLoopData = $pet->bookings->sortByDesc('bookingID'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div>
                                            <p class="font-medium text-gray-900 text-sm">Room <?php echo e($booking->room->roomNum); ?></p>
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
                        <a href="<?php echo e(route('pets.edit', $pet->petID)); ?>"
                           class="flex-1 text-center py-2.5 px-5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-all">
                            Edit Pet
                        </a>
                        <form method="POST" action="<?php echo e(route('pets.destroy', $pet->petID)); ?>" class="flex-1"
                              onsubmit="return confirm('Delete <?php echo e($pet->petName); ?>?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="w-full py-2.5 px-5 bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition-all">
                                Delete Pet
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
<?php /**PATH C:\Users\Administrator\Downloads\PETHOTELFORIT6-main\resources\views/pets/admin-show.blade.php ENDPATH**/ ?>