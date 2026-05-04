<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-lg fixed h-full">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-blue-500">Pet Hotel</h2>
                </div>

                <nav class="mt-6 px-3">
                    <!-- Dashboard -->
                    <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded-xl transition-all <?php echo e(request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-50'); ?>">
                        <svg class="w-5 h-5 mr-3 <?php echo e(request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-400'); ?>" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Dashboard
                    </a>

                    <!-- Bookings -->
                    <a href="<?php echo e(route('bookings.index')); ?>" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded-xl transition-all <?php echo e(request()->routeIs('bookings.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-50'); ?>">
                        <svg class="w-5 h-5 mr-3 <?php echo e(request()->routeIs('bookings.*') ? 'text-blue-600' : 'text-gray-400'); ?>" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        Bookings
                    </a>

                    <!-- Customers -->
                    <a href="<?php echo e(route('customers.index')); ?>" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded-xl transition-all <?php echo e(request()->routeIs('customers.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-50'); ?>">
                        <svg class="w-5 h-5 mr-3 <?php echo e(request()->routeIs('customers.*') ? 'text-blue-600' : 'text-gray-400'); ?>" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                        </svg>
                        Customers
                    </a>

                    <!-- Employees -->
                    <a href="<?php echo e(route('employees.index')); ?>" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded-xl transition-all <?php echo e(request()->routeIs('employees.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-50'); ?>">
                        <svg class="w-5 h-5 mr-3 <?php echo e(request()->routeIs('employees.*') ? 'text-blue-600' : 'text-gray-400'); ?>" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                        </svg>
                        Employees
                    </a>

                    <!-- Pets -->
                    <a href="<?php echo e(route('pets.index')); ?>" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded-xl transition-all <?php echo e(request()->routeIs('pets.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-50'); ?>">
                        <svg class="w-5 h-5 mr-3 <?php echo e(request()->routeIs('pets.*') ? 'text-blue-600' : 'text-gray-400'); ?>" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                        </svg>
                        Pets
                    </a>

                    <!-- Rooms -->
                    <a href="<?php echo e(route('rooms.index')); ?>" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded-xl transition-all <?php echo e(request()->routeIs('rooms.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-50'); ?>">
                        <svg class="w-5 h-5 mr-3 <?php echo e(request()->routeIs('rooms.*') ? 'text-blue-600' : 'text-gray-400'); ?>" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Rooms
                    </a>

                    <!-- Payments -->
                    <a href="<?php echo e(route('payments.index')); ?>" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded-xl transition-all <?php echo e(request()->routeIs('payments.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-50'); ?>">
                        <svg class="w-5 h-5 mr-3 <?php echo e(request()->routeIs('payments.*') ? 'text-blue-600' : 'text-gray-400'); ?>" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                        </svg>
                        Payments
                    </a>

                    <?php if(auth()->user()->role === 'Admin'): ?>
                    <!-- Add-ons -->
                    <a href="<?php echo e(route('addons.index')); ?>" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded-xl transition-all <?php echo e(request()->routeIs('addons.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-50'); ?>">
                        <svg class="w-5 h-5 mr-3 <?php echo e(request()->routeIs('addons.*') ? 'text-blue-600' : 'text-gray-400'); ?>" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
                        </svg>
                        Add-ons
                    </a>
                    <?php endif; ?>

                    <div class="border-t border-gray-100 my-4"></div>

                    <!-- Profile -->
                    <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded-xl transition-all <?php echo e(request()->routeIs('profile.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-50'); ?>">
                        <svg class="w-5 h-5 mr-3 <?php echo e(request()->routeIs('profile.*') ? 'text-blue-600' : 'text-gray-400'); ?>" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        Profile
                    </a>

                    <!-- Logout -->
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="flex items-center w-full px-4 py-3 text-gray-700 rounded-xl hover:bg-red-50 hover:text-red-600 transition-all">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                            </svg>
                            Sign Out
                        </button>
                    </form>
                </nav>

                <!-- User Info at Bottom -->
                <div class="absolute bottom-0 w-64 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-t border-blue-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-indigo-400 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            <?php echo e(substr(auth()->user()->username, 0, 2)); ?>

                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-bold text-gray-800"><?php echo e(auth()->user()->username); ?></p>
                            <p class="text-xs text-gray-500"><?php echo e(auth()->user()->role); ?></p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col ml-64">
                <!-- Top Header -->
                <header class="bg-white shadow-sm border-b border-gray-100">
                    <div class="px-8 py-6">
                        <?php if(isset($header)): ?>
                            <?php echo e($header); ?>

                        <?php endif; ?>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto p-8 bg-gradient-to-br from-blue-50 to-indigo-50">
                    <?php echo e($slot); ?>

                </main>
            </div>
        </div>
    </body>
</html><?php /**PATH C:\Users\Administrator\Downloads\PETHOTELFORIT6-main\resources\views/components/admin-layout.blade.php ENDPATH**/ ?>