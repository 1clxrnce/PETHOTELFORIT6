<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900">
                    Profile Settings
                </h2>
                <p class="text-gray-600 mt-1">Manage your account information and preferences</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('status') === 'profile-updated')
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    Profile updated successfully!
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Profile Overview -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="text-center">
                            <div class="w-24 h-24 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-white font-bold text-2xl">
                                    {{ substr(auth()->user()->username, 0, 2) }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">{{ auth()->user()->username }}</h3>
                            <p class="text-gray-600 mt-1">{{ auth()->user()->role }}</p>
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <div class="text-sm text-gray-600">
                                    <p><strong>User ID:</strong> {{ auth()->user()->userID }}</p>
                                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                                    <p><strong>Member since:</strong> {{ auth()->user()->created_at ? auth()->user()->created_at->format('M Y') : 'N/A' }}</p>
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
                            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                                @csrf
                                @method('patch')

                                <div class="overflow-x-auto">
                                    <table class="min-w-full">
                                        <tbody class="divide-y divide-gray-200">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50 w-1/3">
                                                    Username
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="text" name="username" value="{{ old('username', $user->username) }}" required 
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('username') border-red-500 @enderror">
                                                    @error('username')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                                    Email Address
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror">
                                                    @error('email')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                    
                                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                                        <div class="mt-2 p-3 bg-yellow-50 border border-yellow-200 rounded-md">
                                                            <p class="text-sm text-yellow-800">
                                                                Your email address is unverified.
                                                                <button form="send-verification" class="underline text-yellow-600 hover:text-yellow-900">
                                                                    Click here to re-send the verification email.
                                                                </button>
                                                            </p>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                                    Role
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                                        {{ $user->role === 'Admin' ? 'bg-purple-100 text-purple-800' : '' }}
                                                        {{ $user->role === 'Staff' ? 'bg-blue-100 text-blue-800' : '' }}
                                                        {{ $user->role === 'Customer' ? 'bg-green-100 text-green-800' : '' }}">
                                                        {{ $user->role }}
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

                            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                @csrf
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
                            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                                @csrf
                                @method('put')

                                <div class="overflow-x-auto">
                                    <table class="min-w-full">
                                        <tbody class="divide-y divide-gray-200">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50 w-1/3">
                                                    Current Password
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="password" name="current_password" required 
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('current_password', 'updatePassword') border-red-500 @enderror">
                                                    @error('current_password', 'updatePassword')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                                    New Password
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="password" name="password" required 
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password', 'updatePassword') border-red-500 @enderror">
                                                    @error('password', 'updatePassword')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50">
                                                    Confirm Password
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="password" name="password_confirmation" required 
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password_confirmation', 'updatePassword') border-red-500 @enderror">
                                                    @error('password_confirmation', 'updatePassword')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
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
                            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                                @csrf
                                @method('delete')

                                <div class="overflow-x-auto">
                                    <table class="min-w-full">
                                        <tbody>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 bg-gray-50 w-1/3">
                                                    Confirm Password
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <input type="password" name="password" placeholder="Enter your password to confirm" required 
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent @error('password', 'userDeletion') border-red-500 @enderror">
                                                    @error('password', 'userDeletion')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
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
</x-admin-layout>
