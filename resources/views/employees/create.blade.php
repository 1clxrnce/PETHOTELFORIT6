<x-admin-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('employees.index') }}" 
                       class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">Add Employee</h1>
                </div>
                <p class="text-gray-600">Create a new employee account</p>
            </div>

            @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                    <div class="flex items-center gap-3 mb-2">
                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-red-800 font-semibold">Please fix the following errors:</span>
                    </div>
                    <ul class="list-disc list-inside text-red-700 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Employee Form -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Employee Information</h2>
                </div>

                <form action="{{ route('employees.store') }}" method="POST" class="p-6">
                    @csrf

                    <table class="w-full">
                        <tbody class="divide-y divide-gray-200">
                            <!-- Employee ID (Auto-generated) -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700 w-1/3">
                                    Employee ID
                                </td>
                                <td class="py-4">
                                    <input type="text" 
                                           value="Auto-generated" 
                                           readonly
                                           class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
                                </td>
                            </tr>

                            <!-- User ID (Auto-generated) -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    User ID
                                </td>
                                <td class="py-4">
                                    <input type="text" 
                                           value="Auto-assigned" 
                                           readonly
                                           class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
                                </td>
                            </tr>

                            <!-- Username -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Username <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <input type="text" 
                                           name="username" 
                                           id="username"
                                           value="{{ old('username') }}"
                                           required
                                           class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('username') border-red-500 @enderror">
                                    @error('username')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <!-- Password -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Password <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <input type="password" 
                                           name="password" 
                                           id="password"
                                           required
                                           class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('password') border-red-500 @enderror">
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                    <p class="text-sm text-gray-500 mt-1">Minimum 6 characters</p>
                                </td>
                            </tr>

                            <!-- Role -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Role <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <select name="role" 
                                            id="role"
                                            required
                                            class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('role') border-red-500 @enderror">
                                        <option value="">Select role</option>
                                        <option value="Staff" {{ old('role') == 'Staff' ? 'selected' : '' }}>Staff</option>
                                        <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    @error('role')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <!-- First Name -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    First Name <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <input type="text" 
                                           name="empFName" 
                                           id="empFName"
                                           value="{{ old('empFName') }}"
                                           required
                                           class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('empFName') border-red-500 @enderror">
                                    @error('empFName')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <!-- Middle Name -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Middle Name
                                </td>
                                <td class="py-4">
                                    <input type="text" 
                                           name="empMName" 
                                           id="empMName"
                                           value="{{ old('empMName') }}"
                                           class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('empMName') border-red-500 @enderror">
                                    @error('empMName')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <!-- Last Name -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Last Name <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <input type="text" 
                                           name="empLName" 
                                           id="empLName"
                                           value="{{ old('empLName') }}"
                                           required
                                           class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('empLName') border-red-500 @enderror">
                                    @error('empLName')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <!-- Phone Number -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Phone Number <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <input type="tel" 
                                           name="phoneNum" 
                                           id="phoneNum"
                                           value="{{ old('phoneNum') }}"
                                           required
                                           class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('phoneNum') border-red-500 @enderror">
                                    @error('phoneNum')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <!-- Email -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Email <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <input type="email" 
                                           name="email" 
                                           id="email"
                                           value="{{ old('email') }}"
                                           required
                                           class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('email') border-red-500 @enderror">
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <!-- Birthdate -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Birthdate <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <input type="date" 
                                           name="birthdate" 
                                           id="birthdate"
                                           value="{{ old('birthdate') }}"
                                           required
                                           class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('birthdate') border-red-500 @enderror">
                                    @error('birthdate')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <!-- Gender -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Gender <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <select name="gender" 
                                            id="gender"
                                            required
                                            class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('gender') border-red-500 @enderror">
                                        <option value="">Select gender</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <!-- Address -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Address <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <textarea name="address" 
                                              id="address"
                                              rows="3"
                                              required
                                              class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                                    @error('address')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <!-- Hire Date -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Hire Date <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <input type="date" 
                                           name="hireDate" 
                                           id="hireDate"
                                           value="{{ old('hireDate', date('Y-m-d')) }}"
                                           required
                                           class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('hireDate') border-red-500 @enderror">
                                    @error('hireDate')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('employees.index') }}" 
                           class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-lg text-center transition-all">
                            Back
                        </a>
                        <button type="submit" 
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all">
                            Save Employee
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>