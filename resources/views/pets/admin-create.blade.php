<x-admin-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Add Pet</h1>
            </div>

            @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                    <ul class="text-sm text-red-700 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
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
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 @error('cusID') border-red-500 @enderror">
                                            <option value="">Select Customer</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->cusID }}" {{ old('cusID', request('customer_id')) == $customer->cusID ? 'selected' : '' }}>
                                                    {{ $customer->cusID }} - {{ $customer->cusFName }} {{ $customer->cusLName }}
                                                </option>
                                            @endforeach
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
                                               value="{{ old('petName') }}"
                                               required
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 @error('petName') border-red-500 @enderror">
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
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 @error('petType') border-red-500 @enderror">
                                            <option value="">Select Type</option>
                                            <option value="Cat" {{ old('petType') == 'Cat' ? 'selected' : '' }}>Cat</option>
                                            <option value="Dog" {{ old('petType') == 'Dog' ? 'selected' : '' }}>Dog</option>
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
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 @error('breed') border-red-500 @enderror">
                                            <option value="">Select pet type first</option>
                                        </select>
                                        <div id="customBreedContainer" class="mt-2 hidden">
                                            <input type="text" name="customBreed" id="customBreed"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                                                   placeholder="Enter custom breed name">
                                        </div>
                                        @error('breed')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </td>
                                </tr>

                                <!-- Gender -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Gender <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select name="gender" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 @error('gender') border-red-500 @enderror">
                                            <option value="">Select Gender</option>
                                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
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
                                               value="{{ old('birthdate') }}"
                                               required
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 @error('birthdate') border-red-500 @enderror">
                                    </td>
                                </tr>

                                <!-- Weight Size -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Weight Size <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select name="weightSize" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 @error('weightSize') border-red-500 @enderror">
                                            <option value="">Select Size</option>
                                            <option value="S" {{ old('weightSize') == 'S' ? 'selected' : '' }}>Small (S)</option>
                                            <option value="M" {{ old('weightSize') == 'M' ? 'selected' : '' }}>Medium (M)</option>
                                            <option value="L" {{ old('weightSize') == 'L' ? 'selected' : '' }}>Large (L)</option>
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
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 @error('vaccinationFile') border-red-500 @enderror">
                                        <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG - Max 5MB</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Action Buttons -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                        <a href="{{ route('pets.index') }}" 
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

    @include('pets.partials.breed-script')
    <script>
        initBreedDropdown('petType', 'breed', 'customBreedContainer', 'customBreed', '{{ old('breed') }}');
    </script>
</x-admin-layout>