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
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Add Payment</h1>
                <p class="text-gray-600 mt-1">Record a new payment for booking #<?php echo e($booking->bookingID); ?></p>
            </div>

            <!-- Booking Summary Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Booking Details</h2>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Booking ID:</span>
                        <span class="text-gray-900 font-medium ml-2">#<?php echo e($booking->bookingID); ?></span>
                    </div>
                    <div>
                        <span class="text-gray-600">Customer:</span>
                        <span class="text-gray-900 font-medium ml-2"><?php echo e($booking->customer->cusFName); ?> <?php echo e($booking->customer->cusLName); ?></span>
                    </div>
                    <div>
                        <span class="text-gray-600">Pet:</span>
                        <span class="text-gray-900 font-medium ml-2"><?php echo e($booking->pet->petName); ?></span>
                    </div>
                    <div>
                        <span class="text-gray-600">Room:</span>
                        <span class="text-gray-900 font-medium ml-2"><?php echo e($booking->room->roomNum); ?></span>
                    </div>
                    <div>
                        <span class="text-gray-600">Check-in:</span>
                        <span class="text-gray-900 font-medium ml-2"><?php echo e(\Carbon\Carbon::parse($booking->checkInDate)->format('M d, Y')); ?></span>
                    </div>
                    <div>
                        <span class="text-gray-600">Check-out:</span>
                        <span class="text-gray-900 font-medium ml-2"><?php echo e(\Carbon\Carbon::parse($booking->checkOutDate)->format('M d, Y')); ?></span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-gray-600">Total Amount:</span>
                        <span class="text-gray-900 font-bold text-lg ml-2">₱<?php echo e(number_format($booking->totalAmount, 2)); ?></span>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Payment Information</h2>
                </div>

                <?php if($errors->any()): ?>
                    <div class="m-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                        <div class="flex">
                            <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('payments.store')); ?>" method="POST" class="p-6">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="bookingID" value="<?php echo e($booking->bookingID); ?>">

                    <table class="w-full">
                        <tbody class="divide-y divide-gray-200">
                            <!-- Payment ID (Auto-generated) -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700 w-1/3">
                                    Payment ID
                                </td>
                                <td class="py-4">
                                    <input type="text" 
                                           value="Auto-generated" 
                                           readonly
                                           class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
                                </td>
                            </tr>

                            <!-- Booking ID (Read-only) -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Booking ID
                                </td>
                                <td class="py-4">
                                    <input type="text" 
                                           value="<?php echo e($booking->bookingID); ?>" 
                                           readonly
                                           class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
                                </td>
                            </tr>

                            <!-- Payment Date -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Payment Date <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <input type="date" 
                                           name="paymentDate" 
                                           id="paymentDate" 
                                           value="<?php echo e(old('paymentDate', date('Y-m-d'))); ?>"
                                           required
                                           class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all <?php $__errorArgs = ['paymentDate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <?php $__errorArgs = ['paymentDate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </td>
                            </tr>

                            <!-- Amount -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Amount <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold">₱</span>
                                        <input type="number" 
                                               name="amount" 
                                               id="amount" 
                                               step="0.01"
                                               min="0"
                                               value="<?php echo e(old('amount', $booking->totalAmount)); ?>"
                                               required
                                               class="w-full pl-8 pr-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    </div>
                                    <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Booking Total: ₱<?php echo e(number_format($booking->totalAmount, 2)); ?>

                                    </p>
                                </td>
                            </tr>

                            <!-- Payment Method -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Payment Method <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <select name="paymentMethod" 
                                            id="paymentMethod" 
                                            required
                                            class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all <?php $__errorArgs = ['paymentMethod'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <option value="">Select payment method</option>
                                        <option value="Cash" <?php echo e(old('paymentMethod') == 'Cash' ? 'selected' : ''); ?>>Cash</option>
                                        <option value="GCash" <?php echo e(old('paymentMethod') == 'GCash' ? 'selected' : ''); ?>>GCash</option>
                                        <option value="Bank Transfer" <?php echo e(old('paymentMethod') == 'Bank Transfer' ? 'selected' : ''); ?>>Bank Transfer</option>
                                    </select>
                                    <?php $__errorArgs = ['paymentMethod'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </td>
                            </tr>


                        </tbody>
                    </table>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex gap-3">
                        <a href="<?php echo e(route('payments.selectBooking')); ?>" 
                           class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-lg text-center transition-all">
                            Back
                        </a>
                        <button type="submit" 
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all">
                            Save Payment
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
<?php /**PATH C:\Users\Administrator\Downloads\PETHOTELFORIT6-main\resources\views/payments/create.blade.php ENDPATH**/ ?>