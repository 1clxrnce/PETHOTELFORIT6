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
        <h2 class="font-bold text-2xl text-gray-900">
            Edit Pet
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form method="POST" action="<?php echo e(route('customer.pets.update', $pet->petID)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <input type="hidden" name="cusID" value="<?php echo e($pet->cusID); ?>">

                <div class="space-y-6">
                    <!-- Pet ID (Read-only) -->
                    <div>
                        <label for="petID" class="block text-sm font-semibold text-gray-700 mb-2">Pet ID</label>
                        <input type="text" id="petID" value="<?php echo e($pet->petID); ?>" readonly
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-600 cursor-not-allowed"
                            placeholder="Auto-generated">
                    </div>

                    <!-- Customer ID (Read-only) -->
                    <div>
                        <label for="cusID_display" class="block text-sm font-semibold text-gray-700 mb-2">Customer ID</label>
                        <input type="text" id="cusID_display" value="<?php echo e($pet->cusID); ?>" readonly
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-600 cursor-not-allowed">
                    </div>
                    <!-- Pet Name -->
                    <div>
                        <label for="petName" class="block text-sm font-semibold text-gray-700 mb-2">Pet Name *</label>
                        <input type="text" name="petName" id="petName" value="<?php echo e(old('petName', $pet->petName)); ?>" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
                            placeholder="Enter pet name">
                        <?php $__errorArgs = ['petName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Pet Type -->
                    <div>
                        <label for="petType" class="block text-sm font-semibold text-gray-700 mb-2">Pet Type *</label>
                        <select name="petType" id="petType" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all appearance-none bg-white"
                            style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em 1.5em;">
                            <option value="">Select Type</option>
                            <option value="Dog" <?php echo e(old('petType', $pet->petType) == 'Dog' ? 'selected' : ''); ?>>Dog</option>
                            <option value="Cat" <?php echo e(old('petType', $pet->petType) == 'Cat' ? 'selected' : ''); ?>>Cat</option>
                        </select>
                        <?php $__errorArgs = ['petType'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Breed -->
                    <div>
                        <label for="breed" class="block text-sm font-semibold text-gray-700 mb-2">Breed *</label>
                        <select name="breed" id="breed" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all appearance-none bg-white"
                            style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em 1.5em;">
                            <option value="">Select pet type first</option>
                        </select>
                        <?php $__errorArgs = ['breed'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        
                        <!-- Custom Breed Input -->
                        <div id="customBreedContainer" class="mt-3 hidden">
                            <input type="text" name="customBreed" id="customBreed" 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
                                placeholder="Enter custom breed name">
                        </div>
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-sm font-semibold text-gray-700 mb-2">Gender *</label>
                        <select name="gender" id="gender" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all appearance-none bg-white"
                            style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em 1.5em;">
                            <option value="">Select Gender</option>
                            <option value="Male" <?php echo e(old('gender', $pet->gender) == 'Male' ? 'selected' : ''); ?>>Male</option>
                            <option value="Female" <?php echo e(old('gender', $pet->gender) == 'Female' ? 'selected' : ''); ?>>Female</option>
                        </select>
                        <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Birthdate -->
                    <div>
                        <label for="birthdate" class="block text-sm font-semibold text-gray-700 mb-2">Birthdate *</label>
                        <input type="date" name="birthdate" id="birthdate" value="<?php echo e(old('birthdate', $pet->birthdate->format('Y-m-d'))); ?>" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all">
                        <?php $__errorArgs = ['birthdate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Weight Size -->
                    <div>
                        <label for="weightSize" class="block text-sm font-semibold text-gray-700 mb-2">Size *</label>
                        <select name="weightSize" id="weightSize" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all appearance-none bg-white"
                            style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em 1.5em;">
                            <option value="">Select Size</option>
                            <option value="S" <?php echo e(old('weightSize', $pet->weightSize) == 'S' ? 'selected' : ''); ?>>Small (S)</option>
                            <option value="M" <?php echo e(old('weightSize', $pet->weightSize) == 'M' ? 'selected' : ''); ?>>Medium (M)</option>
                            <option value="L" <?php echo e(old('weightSize', $pet->weightSize) == 'L' ? 'selected' : ''); ?>>Large (L)</option>
                        </select>
                        <?php $__errorArgs = ['weightSize'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Current Pet Photo -->
                    <?php if($pet->petPhoto): ?>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Current Photo</label>
                        <img src="<?php echo e(asset('storage/' . $pet->petPhoto)); ?>" alt="<?php echo e($pet->petName); ?>" class="w-32 h-32 object-cover rounded-xl border-2 border-gray-200">
                    </div>
                    <?php endif; ?>

                    <!-- Pet Photo -->
                    <div>
                        <label for="petPhoto" class="block text-sm font-semibold text-gray-700 mb-2">Pet Photo (Optional - Leave empty to keep current)</label>
                        <div class="relative">
                            <input type="file" name="petPhoto" id="petPhoto" accept="image/*"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Max size: 2MB</p>
                        <?php $__errorArgs = ['petPhoto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Vaccination File -->
                    <div>
                        <label for="vaccinationFile" class="block text-sm font-semibold text-gray-700 mb-2">Vaccination File (Optional - Leave empty to keep current)</label>
                        <div class="relative">
                            <input type="file" name="vaccinationFile" id="vaccinationFile" accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Upload vaccination records (PDF, JPG, PNG - Max 5MB)</p>
                        <?php $__errorArgs = ['vaccinationFile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 mt-8 pt-6 border-t border-gray-100">
                    <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-4 px-6 rounded-xl transition-all shadow-sm hover:shadow-md">
                        Update Pet
                    </button>
                    <a href="<?php echo e(route('customer.pets.index')); ?>" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-4 px-6 rounded-xl text-center transition-all">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <?php echo $__env->make('pets.partials.breed-script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script>
        initBreedDropdown('petType', 'breed', 'customBreedContainer', 'customBreed', '<?php echo e(old('breed', $pet->breed)); ?>');
    </script>
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
<?php /**PATH C:\Users\Administrator\Downloads\PETHOTELFORIT6-main\resources\views/pets/edit.blade.php ENDPATH**/ ?>