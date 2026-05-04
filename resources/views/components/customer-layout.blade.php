<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
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
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Dashboard
                    </a>

                    <!-- My Pets -->
                    <a href="{{ route('customer.pets.index') }}" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded-xl transition-all {{ request()->routeIs('customer.pets.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('customer.pets.*') ? 'text-blue-600' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                        </svg>
                        My Pets
                    </a>

                    <!-- Browse Rooms -->
                    <a href="{{ route('customer.rooms.browse') }}" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded-xl transition-all {{ request()->routeIs('customer.rooms.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('customer.rooms.*') ? 'text-blue-600' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Book a Room
                    </a>

                    <!-- My Bookings -->
                    <a href="{{ route('customer.bookings.index') }}" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded-xl transition-all {{ request()->routeIs('customer.bookings.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('customer.bookings.*') ? 'text-blue-600' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        My Bookings
                    </a>

                    <!-- My Payments -->
                    <a href="{{ route('customer.payments.index') }}" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded-xl transition-all {{ request()->routeIs('customer.payments.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('customer.payments.*') ? 'text-blue-600' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                        </svg>
                        Payments
                    </a>

                    <div class="border-t border-gray-100 my-4"></div>

                    <!-- Profile -->
                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded-xl transition-all {{ request()->routeIs('profile.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('profile.*') ? 'text-blue-600' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        Profile
                    </a>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
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
                    @php
                        $customer = auth()->user()->customer;
                        $displayName = $customer
                            ? $customer->cusFName . ' ' . $customer->cusLName
                            : auth()->user()->username;
                        $initials = $customer
                            ? substr($customer->cusFName, 0, 1) . substr($customer->cusLName, 0, 1)
                            : strtoupper(substr(auth()->user()->username, 0, 2));
                    @endphp
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-indigo-400 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            {{ $initials }}
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-bold text-gray-800">{{ $displayName }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->username }}</p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col ml-64">
                <!-- Top Header -->
                <header class="bg-white shadow-sm border-b border-gray-100">
                    <div class="px-8 py-6">
                        @if (isset($header))
                            {{ $header }}
                        @endif
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto p-8 bg-gray-50">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
