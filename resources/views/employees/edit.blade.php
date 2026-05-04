<x-admin-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('employees.show', $employee->empID) }}" 
                       class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Employee</h1>
                </div>
                <p class="text-gray-600">Employee ID: #{{ $employee->empID }}</p>
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

                <form action="{{ route('employees.update', $employee->empID) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <table class="w-full">
                        <tbody class="divide-y divide-gray-200">
                            <!-- Employee ID (Read-only) -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700 w-1/3">
                                    Employee ID
                                </td>
                                <td class="py-4">
                                    <input type="text" 
                                           value="{{ $employee->empID }}" 
                                           readonly
                                           class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
                                </td>
                            </tr>

                            <!-- User ID (Read-only) -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    User ID
                                </td>
                                <td class="py-4">
                                    <input type="text" 
                                           value="{{ $employee->userID }}" 
                                           readonly
                                           class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
                                </td>
                            </tr>

                            <!-- Username (Read-only) -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Username
                                </td>
                                <td class="py-4">
                                    <input type="text" 
                                           value="{{ $employee->user->username ?? 'N/A' }}" 
                                           readonly
                                           class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
                                    <p class="text-sm text-gray-500 mt-1">Username cannot be changed</p>
                                </td>
                            </tr>

                            <!-- Role (Read-only) -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Role
                                </td>
                                <td class="py-4">
                                    <input type="text" 
                                           value="{{ $employee->user->role ?? 'N/A' }}" 
                                           readonly
                                           class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
                                    <p class="text-sm text-gray-500 mt-1">Role cannot be changed</p>
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
                                           value="{{ old('empFName', $employee->empFName) }}"
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
                                           value="{{ old('empMName', $employee->empMName) }}"
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
                                           value="{{ old('empLName', $employee->empLName) }}"
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
                                           value="{{ old('phoneNum', $employee->phoneNum) }}"
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
                                           value="{{ old('email', $employee->email) }}"
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
                                           value="{{ old('birthdate', $employee->birthdate) }}"
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
                                        <option value="Male" {{ old('gender', $employee->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender', $employee->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('gender', $employee->gender) == 'Other' ? 'selected' : '' }}>Other</option>
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
                                              class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('address') border-red-500 @enderror">{{ old('address', $employee->address) }}</textarea>
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
                                           value="{{ old('hireDate', $employee->hireDate) }}"
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
                        <a href="{{ route('employees.show', $employee->empID) }}" 
                           class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-lg text-center transition-all">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>