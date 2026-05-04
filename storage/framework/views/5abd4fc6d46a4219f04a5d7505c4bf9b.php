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
        <div class="max-w-7xl mx-auto">
            <?php if(session('success')): ?>
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-green-800"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>

            <!-- Customer Info Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="flex items-start justify-between">
                    <div class="flex items-start gap-6">
                        <div class="w-20 h-20 rounded-full bg-blue-600 flex items-center justify-center text-white text-2xl font-bold">
                            <?php echo e(strtoupper(substr($customer->cusFName, 0, 1) . substr($customer->cusLName, 0, 1))); ?>

                        </div>

                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 mb-4">Customer Information</h1>
                            
                            <div class="grid grid-cols-2 gap-x-8 gap-y-2 text-sm">
                                <div class="flex">
                                    <span class="text-gray-500 w-28">cusID:</span>
                                    <span class="text-gray-900 font-medium"><?php echo e($customer->cusID); ?></span>
                                </div>
                                <?php if($customer->user): ?>
                                <div class="flex">
                                    <span class="text-gray-500 w-28">userID:</span>
                                    <span class="text-gray-900 font-medium"><?php echo e($customer->userID); ?></span>
                                </div>
                                <?php endif; ?>
                                <div class="flex">
                                    <span class="text-gray-500 w-28">cusFName:</span>
                                    <span class="text-gray-900 font-medium"><?php echo e($customer->cusFName); ?></span>
                                </div>
                                <?php if($customer->cusMName): ?>
                                <div class="flex">
                                    <span class="text-gray-500 w-28">cusMName:</span>
                                    <span class="text-gray-900 font-medium"><?php echo e($customer->cusMName); ?></span>
                                </div>
                                <?php endif; ?>
                                <div class="flex">
                                    <span class="text-gray-500 w-28">cusLName:</span>
                                    <span class="text-gray-900 font-medium"><?php echo e($customer->cusLName); ?></span>
                                </div>
                                <div class="flex">
                                    <span class="text-gray-500 w-28">phoneNum:</span>
                                    <span class="text-gray-900 font-medium"><?php echo e($customer->phoneNum); ?></span>
                                </div>
                                <div class="flex col-span-2">
                                    <span class="text-gray-500 w-28">email:</span>
                                    <span class="text-gray-900 font-medium"><?php echo e($customer->email); ?></span>
                                </div>
                                <?php if($customer->address): ?>
                                <div class="flex col-span-2">
                                    <span class="text-gray-500 w-28">address:</span>
                                    <span class="text-gray-900 font-medium"><?php echo e($customer->address); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <a href="<?php echo e(route('customers.edit', $customer->cusID)); ?>" 
                           class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                            Edit
                        </a>
                        <a href="<?php echo e(route('customers.index')); ?>" 
                           class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-colors">
                            Back
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pets Section -->
            <?php if($customer->pets->count() > 0): ?>
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Registered Pets</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php $__currentLoopData = $customer->pets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors">
                            <div class="flex items-center gap-3 mb-3">
                                <?php if($pet->petPhoto): ?>
                                    <img src="<?php echo e(asset('storage/' . $pet->petPhoto)); ?>" alt="<?php echo e($pet->petName); ?>"
                                         class="w-12 h-12 rounded-full object-cover border border-gray-200">
                                <?php else: ?>
                                    <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-2xl">
                                        <?php echo e(strtolower($pet->petType) === 'cat' ? '🐱' : (strtolower($pet->petType) === 'dog' ? '🐶' : '🐾')); ?>

                                    </div>
                                <?php endif; ?>
                                <div>
                                    <h3 class="font-bold text-gray-900"><?php echo e($pet->petName); ?></h3>
                                    <p class="text-sm text-gray-500"><?php echo e(ucfirst($pet->petType)); ?></p>
                                </div>
                            </div>
                            <div class="space-y-1 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Breed:</span>
                                    <span class="text-gray-900 font-medium"><?php echo e($pet->breed); ?></span>
                                </div>
                                <?php if($pet->birthdate): ?>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Age:</span>
                                    <span class="text-gray-900 font-medium"><?php echo e(\Carbon\Carbon::parse($pet->birthdate)->age); ?> years</span>
                                </div>
                                <?php endif; ?>
                                <?php if($pet->gender): ?>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Gender:</span>
                                    <span class="text-gray-900 font-medium"><?php echo e(ucfirst($pet->gender)); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php else: ?>
            <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No pets registered</h3>
                <p class="text-gray-500 mb-4">Add a pet to get started</p>
                <a href="<?php echo e(route('pets.create')); ?>?customer_id=<?php echo e($customer->cusID); ?>" 
                   class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add Pet
                </a>
            </div>
            <?php endif; ?>

            <!-- Bookings Section -->
            <?php if($customer->bookings && $customer->bookings->count() > 0): ?>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Booking History</h2>
                <div class="space-y-3">
                    <?php $__currentLoopData = $customer->bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border border-gray-200 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold">
                                    #<?php echo e($booking->bookingID); ?>

                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="px-2 py-1 text-xs font-semibold rounded 
                                            <?php if($booking->status === 'Confirmed'): ?> bg-green-100 text-green-700
                                            <?php elseif($booking->status === 'Pending'): ?> bg-yellow-100 text-yellow-700
                                            <?php elseif($booking->status === 'Completed'): ?> bg-blue-100 text-blue-700
                                            <?php else: ?> bg-red-100 text-red-700
                                            <?php endif; ?>">
                                            <?php echo e($booking->status); ?>

                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600">
                                        <?php echo e(\Carbon\Carbon::parse($booking->checkInDate)->format('M d, Y')); ?> - 
                                        <?php echo e(\Carbon\Carbon::parse($booking->checkOutDate)->format('M d, Y')); ?>

                                    </p>
                                </div>
                            </div>
                            <a href="<?php echo e(route('bookings.show', $booking->bookingID)); ?>" 
                               class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">
                                View Details
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
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
<?php /**PATH C:\Users\Administrator\Downloads\PETHOTELFORIT6-main\resources\views/customers/show.blade.php ENDPATH**/ ?>