<x-admin-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto">
            <div class="mb-6 flex items-center gap-3">
                <a href="{{ route('pets.show', $pet->petID) }}" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Edit Pet</h1>
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

            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <form action="{{ route('pets.update', $pet->petID) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="cusID" value="{{ $pet->cusID }}">

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-48">Field</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Pet ID</td>
                                    <td class="px-6 py-4">
                                        <input type="text" value="{{ $pet->petID }}" disabled
                                               class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50 text-gray-500">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Customer</td>
                                    <td class="px-6 py-4">
                                        <select name="cusID" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->cusID }}" {{ old('cusID', $pet->cusID) == $customer->cusID ? 'selected' : '' }}>
                                                    {{ $customer->cusID }} - {{ $customer->cusFName }} {{ $customer->cusLName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Pet Name <span class="text-red-500">*</span></td>
                                    <td class="px-6 py-4">
                                        <input type="text" name="petName" value="{{ old('petName', $pet->petName) }}" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 @error('petName') border-red-500 @enderror">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Pet Type <span class="text-red-500">*</span></td>
                                    <td class="px-6 py-4">
                                        <select name="petType" id="petType" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                            <option value="">Select Type</option>
                                            <option value="Dog" {{ old('petType', $pet->petType) == 'Dog' ? 'selected' : '' }}>Dog</option>
                                            <option value="Cat" {{ old('petType', $pet->petType) == 'Cat' ? 'selected' : '' }}>Cat</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Breed <span class="text-red-500">*</span></td>
                                    <td class="px-6 py-4">
                                        <select name="breed" id="breed" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 @error('breed') border-red-500 @enderror">
                                            <option value="">Select pet type first</option>
                                        </select>
                                        <div id="customBreedContainer" class="mt-2 hidden">
                                            <input type="text" name="customBreed" id="customBreed"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                                                   placeholder="Enter custom breed name">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Gender <span class="text-red-500">*</span></td>
                                    <td class="px-6 py-4">
                                        <select name="gender" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                            <option value="">Select Gender</option>
                                            <option value="Male" {{ old('gender', $pet->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender', $pet->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Birthdate <span class="text-red-500">*</span></td>
                                    <td class="px-6 py-4">
                                        <input type="date" name="birthdate" value="{{ old('birthdate', $pet->birthdate->format('Y-m-d')) }}" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Size <span class="text-red-500">*</span></td>
                                    <td class="px-6 py-4">
                                        <select name="weightSize" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                            <option value="">Select Size</option>
                                            <option value="S" {{ old('weightSize', $pet->weightSize) == 'S' ? 'selected' : '' }}>Small (S)</option>
                                            <option value="M" {{ old('weightSize', $pet->weightSize) == 'M' ? 'selected' : '' }}>Medium (M)</option>
                                            <option value="L" {{ old('weightSize', $pet->weightSize) == 'L' ? 'selected' : '' }}>Large (L)</option>
                                        </select>
                                    </td>
                                </tr>
                                @if($pet->petPhoto)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Current Photo</td>
                                    <td class="px-6 py-4">
                                        <img src="{{ asset('storage/' . $pet->petPhoto) }}" alt="{{ $pet->petName }}" class="w-24 h-24 object-cover rounded-lg border border-gray-200">
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Pet Photo</td>
                                    <td class="px-6 py-4">
                                        <input type="file" name="petPhoto" accept="image/*"
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                        <p class="text-xs text-gray-500 mt-1">Leave empty to keep current. Max 2MB.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Vaccination File</td>
                                    <td class="px-6 py-4">
                                        <input type="file" name="vaccinationFile" accept=".pdf,.jpg,.jpeg,.png"
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                        <p class="text-xs text-gray-500 mt-1">Leave empty to keep current. PDF, JPG, PNG - Max 5MB.</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between">
                        <a href="{{ route('pets.show', $pet->petID) }}"
                           class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded">
                            Update Pet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('pets.partials.breed-script')
    <script>
        initBreedDropdown('petType', 'breed', 'customBreedContainer', 'customBreed', '{{ old('breed', $pet->breed) }}');
    </script>
</x-admin-layout>
