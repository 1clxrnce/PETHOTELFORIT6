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
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Add Customer</h1>
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

            <!-- Form -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <form action="<?php echo e(route('customers.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-48">Field</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Customer ID -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Customer ID
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="text" 
                                               value="Auto-assigned"
                                               disabled
                                               class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50 text-gray-500">
                                    </td>
                                </tr>

                                <!-- User ID -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        User ID
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="text" 
                                               value="Auto-assigned"
                                               disabled
                                               class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50 text-gray-500">
                                    </td>
                                </tr>

                                <!-- Username -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Username <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="text" 
                                               name="username" 
                                               value="<?php echo e(old('username')); ?>"
                                               required
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    </td>
                                </tr>

                                <!-- Password -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Password <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="password" 
                                               name="password" 
                                               required
                                               minlength="6"
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    </td>
                                </tr>

                                <!-- First Name -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        First Name <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="text" 
                                               name="cusFName" 
                                               value="<?php echo e(old('cusFName')); ?>"
                                               required
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 <?php $__errorArgs = ['cusFName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    </td>
                                </tr>

                                <!-- Middle Name -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Middle Name
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="text" 
                                               name="cusMName" 
                                               value="<?php echo e(old('cusMName')); ?>"
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    </td>
                                </tr>

                                <!-- Last Name -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Last Name <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="text" 
                                               name="cusLName" 
                                               value="<?php echo e(old('cusLName')); ?>"
                                               required
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 <?php $__errorArgs = ['cusLName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    </td>
                                </tr>

                                <!-- Phone Number -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Phone Number <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="text" 
                                               name="phoneNum" 
                                               value="<?php echo e(old('phoneNum')); ?>"
                                               required
                                               placeholder="09XXXXXXXXX"
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 <?php $__errorArgs = ['phoneNum'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    </td>
                                </tr>

                                <!-- Email -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Email <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="email" 
                                               name="email" 
                                               value="<?php echo e(old('email')); ?>"
                                               required
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    </td>
                                </tr>

                                <!-- Address -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Address
                                    </td>
                                    <td class="px-6 py-4">
                                        <textarea name="address" 
                                                  rows="2"
                                                  class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"><?php echo e(old('address')); ?></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Action Buttons -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                        <a href="<?php echo e(route('customers.index')); ?>" 
                           class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded">
                            Back
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded">
                            Save Customer
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
<?php /**PATH C:\Users\Administrator\Downloads\PETHOTELFORIT6-main\resources\views/customers/create.blade.php ENDPATH**/ ?>