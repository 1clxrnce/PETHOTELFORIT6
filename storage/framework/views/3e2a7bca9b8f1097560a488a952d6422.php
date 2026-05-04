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
            <div class="mb-6 flex items-center gap-3">
                <a href="<?php echo e(route('rooms.show', $room->roomID)); ?>" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Edit Room <?php echo e($room->roomNum); ?></h1>
            </div>

            <?php if($errors->any()): ?>
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                    <ul class="text-sm text-red-700 list-disc list-inside">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <form action="<?php echo e(route('rooms.update', $room->roomID)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-48">Field</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Room ID</td>
                                    <td class="px-6 py-4">
                                        <input type="text" value="<?php echo e($room->roomID); ?>" disabled
                                               class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50 text-gray-500">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Room Type <span class="text-red-500">*</span></td>
                                    <td class="px-6 py-4">
                                        <select name="roomTypeID" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 <?php $__errorArgs = ['roomTypeID'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <option value="">Select Room Type</option>
                                            <?php $__currentLoopData = $roomTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($roomType->roomTypeID); ?>" <?php echo e(old('roomTypeID', $room->roomTypeID) == $roomType->roomTypeID ? 'selected' : ''); ?>>
                                                    <?php echo e($roomType->typeName); ?> - Max <?php echo e($roomType->maxCapacity); ?> pets - ₱<?php echo e(number_format($roomType->pricePerNight, 2)); ?>/night
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Room Number <span class="text-red-500">*</span></td>
                                    <td class="px-6 py-4">
                                        <input type="text" name="roomNum" value="<?php echo e(old('roomNum', $room->roomNum)); ?>" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 <?php $__errorArgs = ['roomNum'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    </td>
                                </tr>
                                <?php if($room->roomPhoto): ?>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Current Photo</td>
                                    <td class="px-6 py-4">
                                        <img src="<?php echo e(asset('storage/' . $room->roomPhoto)); ?>" alt="Room <?php echo e($room->roomNum); ?>" class="w-24 h-24 object-cover rounded-lg border border-gray-200">
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Room Photo</td>
                                    <td class="px-6 py-4">
                                        <input type="file" name="roomPhoto" accept="image/*"
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                        <p class="text-xs text-gray-500 mt-1">Leave empty to keep current. Max 2MB.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Status <span class="text-red-500">*</span></td>
                                    <td class="px-6 py-4">
                                        <select name="status" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <option value="Available" <?php echo e(old('status', $room->status) == 'Available' ? 'selected' : ''); ?>>Available</option>
                                            <option value="Occupied" <?php echo e(old('status', $room->status) == 'Occupied' ? 'selected' : ''); ?>>Occupied</option>
                                            <option value="Maintenance" <?php echo e(old('status', $room->status) == 'Maintenance' ? 'selected' : ''); ?>>Maintenance</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                        <a href="<?php echo e(route('rooms.show', $room->roomID)); ?>"
                           class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded">
                            Update Room
                        </button>
                    </div>
                </form>
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
<?php /**PATH C:\Users\Administrator\Downloads\PETHOTELFORIT6-main\resources\views/rooms/edit.blade.php ENDPATH**/ ?>