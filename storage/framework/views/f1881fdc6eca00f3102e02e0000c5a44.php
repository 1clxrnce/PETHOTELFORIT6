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
            <h2 class="font-bold text-2xl text-gray-900">
                Admin Dashboard
            </h2>
            <div class="text-sm text-gray-600">
                Welcome back, <span class="font-semibold"><?php echo e(auth()->user()->username); ?></span>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Customers -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Customers</p>
                            <p class="text-3xl font-bold text-blue-600"><?php echo e(\App\Models\Customer::count()); ?></p>
                        </div>
                        <div class="text-4xl text-blue-500">👥</div>
                    </div>
                    <div class="mt-4">
                        <a href="<?php echo e(route('customers.index')); ?>" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                            Manage Customers →
                        </a>
                    </div>
                </div>

                <!-- Bookings -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Bookings</p>
                            <p class="text-3xl font-bold text-orange-600"><?php echo e(\App\Models\Booking::count()); ?></p>
                        </div>
                        <div class="text-4xl text-orange-500">📅</div>
                    </div>
                    <div class="mt-4">
                        <a href="<?php echo e(route('bookings.index')); ?>" class="text-orange-600 hover:text-orange-800 font-semibold text-sm">
                            Manage Bookings →
                        </a>
                    </div>
                </div>

                <!-- Pets -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Pets</p>
                            <p class="text-3xl font-bold text-purple-600"><?php echo e(\App\Models\Pet::count()); ?></p>
                        </div>
                        <div class="text-4xl text-purple-500">🐾</div>
                    </div>
                    <div class="mt-4">
                        <a href="<?php echo e(route('pets.index')); ?>" class="text-purple-600 hover:text-purple-800 font-semibold text-sm">
                            Manage Pets →
                        </a>
                    </div>
                </div>

                <!-- Rooms -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Rooms</p>
                            <p class="text-3xl font-bold text-green-600"><?php echo e(\App\Models\Room::count()); ?></p>
                        </div>
                        <div class="text-4xl text-green-500">🏠</div>
                    </div>
                    <div class="mt-4">
                        <a href="<?php echo e(route('rooms.index')); ?>" class="text-green-600 hover:text-green-800 font-semibold text-sm">
                            Manage Rooms →
                        </a>
                    </div>
                </div>

                <!-- Payments -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Payments</p>
                            <p class="text-3xl font-bold text-indigo-600"><?php echo e(\App\Models\Payment::count()); ?></p>
                        </div>
                        <div class="text-4xl text-indigo-500">💳</div>
                    </div>
                    <div class="mt-4">
                        <a href="<?php echo e(route('payments.index')); ?>" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm">
                            View Payments →
                        </a>
                    </div>
                </div>

                <?php if(auth()->user()->role === 'Admin'): ?>
                <!-- Employees -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Employees</p>
                            <p class="text-3xl font-bold text-red-600"><?php echo e(\App\Models\Employee::count()); ?></p>
                        </div>
                        <div class="text-4xl text-red-500">👨‍💼</div>
                    </div>
                    <div class="mt-4">
                        <a href="<?php echo e(route('employees.index')); ?>" class="text-red-600 hover:text-red-800 font-semibold text-sm">
                            Manage Employees →
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="<?php echo e(route('bookings.create')); ?>" 
                        class="flex items-center gap-3 p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all border border-blue-200">
                        <span class="text-2xl">📝</span>
                        <div>
                            <p class="font-semibold text-blue-900">New Booking</p>
                            <p class="text-xs text-blue-700">Create booking</p>
                        </div>
                    </a>

                    <a href="<?php echo e(route('rooms.index')); ?>" 
                        class="flex items-center gap-3 p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-all border border-green-200">
                        <span class="text-2xl">🏠</span>
                        <div>
                            <p class="font-semibold text-green-900">Manage Rooms</p>
                            <p class="text-xs text-green-700">Room status</p>
                        </div>
                    </a>

                    <a href="<?php echo e(route('addons.index')); ?>" 
                        class="flex items-center gap-3 p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-all border border-purple-200">
                        <span class="text-2xl">🎁</span>
                        <div>
                            <p class="font-semibold text-purple-900">Add-ons</p>
                            <p class="text-xs text-purple-700">Manage services</p>
                        </div>
                    </a>

                    <?php if(auth()->user()->role === 'Admin'): ?>
                    <a href="<?php echo e(route('employees.create')); ?>" 
                        class="flex items-center gap-3 p-4 bg-red-50 hover:bg-red-100 rounded-lg transition-all border border-red-200">
                        <span class="text-2xl">👨‍💼</span>
                        <div>
                            <p class="font-semibold text-red-900">Add Employee</p>
                            <p class="text-xs text-red-700">New staff member</p>
                        </div>
                    </a>
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
<?php endif; ?>
<?php /**PATH C:\Users\Administrator\Downloads\PETHOTELFORIT6-main\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>