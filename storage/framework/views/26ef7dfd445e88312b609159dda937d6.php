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
            <div>
                <h2 class="font-bold text-2xl text-gray-900">
                    Profile Settings
                </h2>
                <p class="text-gray-600 mt-1">Manage your account information and preferences</p>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php if(session('status') === 'profile-updated'): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    Profile updated successfully!
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Profile Overview -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="text-center">
                            <div class="w-24 h-24 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-white font-bold text-2xl">
                                    <?php echo e(substr(auth()->user()->username, 0, 2)); ?>

                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900"><?php echo e(auth()->user()->username); ?></h3>
                            <p class="text-gray-600 mt-1"><?php echo e(auth()->user()->role); ?></p>
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <div class="text-sm text-gray-600">
                                    <p><strong>User ID:</strong> <?php echo e(auth()->user()->userID); ?></p>
                                    <p><strong>Email:</strong> <?php echo e(auth()->user()->email); ?></p>
                                    <p><strong>Member since:</strong> <?php echo e(auth()->user()->created_at ? auth()->user()->created_at->format('M Y') : 'N/A'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Forms -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Update Profile Information -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                            <h3 class="text-lg font-bold text-gray-900">Profile Information</h3>
                            <p class="text-sm text-gray-600 mt-1">Update your account's profile information and email address.</p>
                        </div>
                        <div class="p-6">
                            <form method="post" action="<?php echo e(route('profile.update')); ?>" class="space-y-6">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('patch'); ?>

                                <div class="overflow-x-auto">
                                    <table class="min-w-full">
                                        <tbody class="divide-y divide-gray-200">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50 w-1/3">
                                                    Username
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="text" name="username" value="<?php echo e(old('username', $user->username)); ?>" required 
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                    <?php $__errorArgs = ['username'];
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
                                            
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                                    Email Address
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required 
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    
                                                    <?php if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()): ?>
                                                        <div class="mt-2 p-3 bg-yellow-50 border border-yellow-200 rounded-md">
                                                            <p class="text-sm text-yellow-800">
                                                                Your email address is unverified.
                                                                <button form="send-verification" class="underline text-yellow-600 hover:text-yellow-900">
                                                                    Click here to re-send the verification email.
                                                                </button>
                                                            </p>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                                    Role
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                                        <?php echo e($user->role === 'Admin' ? 'bg-purple-100 text-purple-800' : ''); ?>

                                                        <?php echo e($user->role === 'Staff' ? 'bg-blue-100 text-blue-800' : ''); ?>

                                                        <?php echo e($user->role === 'Customer' ? 'bg-green-100 text-green-800' : ''); ?>">
                                                        <?php echo e($user->role); ?>

                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="flex justify-end pt-4 border-t border-gray-200">
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                                        Save Changes
                                    </button>
                                </div>
                            </form>

                            <form id="send-verification" method="post" action="<?php echo e(route('verification.send')); ?>">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                            <h3 class="text-lg font-bold text-gray-900">Update Password</h3>
                            <p class="text-sm text-gray-600 mt-1">Ensure your account is using a long, random password to stay secure.</p>
                        </div>
                        <div class="p-6">
                            <form method="post" action="<?php echo e(route('password.update')); ?>" class="space-y-6">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('put'); ?>

                                <div class="overflow-x-auto">
                                    <table class="min-w-full">
                                        <tbody class="divide-y divide-gray-200">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50 w-1/3">
                                                    Current Password
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="password" name="current_password" required 
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['current_password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                    <?php $__errorArgs = ['current_password', 'updatePassword'];
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
                                            
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                                    New Password
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="password" name="password" required 
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                    <?php $__errorArgs = ['password', 'updatePassword'];
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
                                            
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                                    Confirm Password
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="password" name="password_confirmation" required 
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['password_confirmation', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                    <?php $__errorArgs = ['password_confirmation', 'updatePassword'];
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
                                        </tbody>
                                    </table>
                                </div>

                                <div class="flex justify-end pt-4 border-t border-gray-200">
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                                        Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div class="bg-white rounded-xl shadow-sm border border-red-200 overflow-hidden">
                        <div class="bg-red-50 border-b border-red-200 px-6 py-4">
                            <h3 class="text-lg font-bold text-red-900">Delete Account</h3>
                            <p class="text-sm text-red-600 mt-1">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                        </div>
                        <div class="p-6">
                            <form method="post" action="<?php echo e(route('profile.destroy')); ?>" class="space-y-6" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('delete'); ?>

                                <div class="overflow-x-auto">
                                    <table class="min-w-full">
                                        <tbody>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50 w-1/3">
                                                    Confirm Password
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="password" name="password" placeholder="Enter your password to confirm" required 
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent <?php $__errorArgs = ['password', 'userDeletion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                    <?php $__errorArgs = ['password', 'userDeletion'];
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
                                        </tbody>
                                    </table>
                                </div>

                                <div class="flex justify-end pt-4 border-t border-gray-200">
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">
                                        Delete Account
                                    </button>
                                </div>
                            </form>
                        </div>
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
<?php /**PATH C:\Users\Administrator\Downloads\PETHOTELFORIT6-main\resources\views/profile/edit.blade.php ENDPATH**/ ?>