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
                <h1 class="text-2xl font-bold text-gray-900">Add Pet</h1>
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
                <form action="<?php echo e(route('pets.store')); ?>" method="POST" enctype="multipart/form-data">
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
                                <!-- Pet ID -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Pet ID
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="text" 
                                               value="Auto-assigned"
                                               disabled
                                               class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50 text-gray-500">
                                    </td>
                                </tr>

                                <!-- Customer ID -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Customer ID <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select name="cusID" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 <?php $__errorArgs = ['cusID'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <option value="">Select Customer</option>
                                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($customer->cusID); ?>" <?php echo e(old('cusID', request('customer_id')) == $customer->cusID ? 'selected' : ''); ?>>
                                                    <?php echo e($customer->cusID); ?> - <?php echo e($customer->cusFName); ?> <?php echo e($customer->cusLName); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                </tr>

                                <!-- Pet Name -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Pet Name <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="text" 
                                               name="petName" 
                                               value="<?php echo e(old('petName')); ?>"
                                               required
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 <?php $__errorArgs = ['petName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    </td>
                                </tr>

                                <!-- Pet Photo -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Pet Photo
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="file" 
                                               name="petPhoto" 
                                               accept="image/*"
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                        <p class="text-xs text-gray-500 mt-1">Max size: 2MB</p>
                                    </td>
                                </tr>

                                <!-- Pet Type -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Pet Type <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select name="petType" id="petType" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 <?php $__errorArgs = ['petType'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <option value="">Select Type</option>
                                            <option value="Cat" <?php echo e(old('petType') == 'Cat' ? 'selected' : ''); ?>>Cat</option>
                                            <option value="Dog" <?php echo e(old('petType') == 'Dog' ? 'selected' : ''); ?>>Dog</option>
                                        </select>
                                    </td>
                                </tr>

                                <!-- Breed -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Breed <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select name="breed" id="breed" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 <?php $__errorArgs = ['breed'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <option value="">Select pet type first</option>
                                        </select>
                                        <div id="customBreedContainer" class="mt-2 hidden">
                                            <input type="text" name="customBreed" id="customBreed"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                                                   placeholder="Enter custom breed name">
                                        </div>
                                        <?php $__errorArgs = ['breed'];
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

                                <!-- Gender -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Gender <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select name="gender" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <option value="">Select Gender</option>
                                            <option value="Male" <?php echo e(old('gender') == 'Male' ? 'selected' : ''); ?>>Male</option>
                                            <option value="Female" <?php echo e(old('gender') == 'Female' ? 'selected' : ''); ?>>Female</option>
                                        </select>
                                    </td>
                                </tr>

                                <!-- Birthdate -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Birthdate <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="date" 
                                               name="birthdate" 
                                               value="<?php echo e(old('birthdate')); ?>"
                                               required
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 <?php $__errorArgs = ['birthdate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    </td>
                                </tr>

                                <!-- Weight Size -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Weight Size <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select name="weightSize" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 <?php $__errorArgs = ['weightSize'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <option value="">Select Size</option>
                                            <option value="S" <?php echo e(old('weightSize') == 'S' ? 'selected' : ''); ?>>Small (S)</option>
                                            <option value="M" <?php echo e(old('weightSize') == 'M' ? 'selected' : ''); ?>>Medium (M)</option>
                                            <option value="L" <?php echo e(old('weightSize') == 'L' ? 'selected' : ''); ?>>Large (L)</option>
                                        </select>
                                    </td>
                                </tr>

                                <!-- Vaccination File -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Vaccination File <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="file" 
                                               name="vaccinationFile" 
                                               accept=".pdf,.jpg,.jpeg,.png"
                                               required
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 <?php $__errorArgs = ['vaccinationFile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG - Max 5MB</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Action Buttons -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                        <a href="<?php echo e(route('pets.index')); ?>" 
                           class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded">
                            Back
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded">
                            Save Pet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php echo $__env->make('pets.partials.breed-script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script>
        initBreedDropdown('petType', 'breed', 'customBreedContainer', 'customBreed', '<?php echo e(old('breed')); ?>');
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
<?php endif; ?><?php /**PATH C:\Users\Administrator\Downloads\PETHOTELFORIT6-main\resources\views/pets/admin-create.blade.php ENDPATH**/ ?>