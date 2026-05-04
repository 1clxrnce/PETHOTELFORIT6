<x-customer-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900">
            Add New Pet
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form method="POST" action="{{ route('customer.pets.store') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="cusID" value="{{ auth()->user()->customer->cusID }}">

                <div class="space-y-6">
                    <!-- Pet ID (Auto-generated) -->
                    <div>
                        <label for="petID" class="block text-sm font-semibold text-gray-700 mb-2">Pet ID</label>
                        <input type="text" id="petID" value="Auto-generated after submission" readonly
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-600 cursor-not-allowed italic">
                    </div>

                    <!-- Customer ID (Read-only) -->
                    <div>
                        <label for="cusID_display" class="block text-sm font-semibold text-gray-700 mb-2">Customer ID</label>
                        <input type="text" id="cusID_display" value="{{ auth()->user()->customer->cusID }}" readonly
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-600 cursor-not-allowed">
                    </div>
                    <!-- Pet Name -->
                    <div>
                        <label for="petName" class="block text-sm font-semibold text-gray-700 mb-2">Pet Name *</label>
                        <input type="text" name="petName" id="petName" value="{{ old('petName') }}" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
                            placeholder="Enter pet name">
                        @error('petName')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pet Type -->
                    <div>
                        <label for="petType" class="block text-sm font-semibold text-gray-700 mb-2">Pet Type *</label>
                        <select name="petType" id="petType" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all appearance-none bg-white"
                            style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em 1.5em;">
                            <option value="">Select Type</option>
                            <option value="Dog" {{ old('petType') == 'Dog' ? 'selected' : '' }}>Dog</option>
                            <option value="Cat" {{ old('petType') == 'Cat' ? 'selected' : '' }}>Cat</option>
                        </select>
                        @error('petType')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Breed -->
                    <div>
                        <label for="breed" class="block text-sm font-semibold text-gray-700 mb-2">Breed *</label>
                        <select name="breed" id="breed" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all appearance-none bg-white"
                            style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em 1.5em;">
                            <option value="">Select pet type first</option>
                        </select>
                        @error('breed')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        
                        <!-- Custom Breed Input (Hidden by default) -->
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
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Birthdate -->
                    <div>
                        <label for="birthdate" class="block text-sm font-semibold text-gray-700 mb-2">Birthdate *</label>
                        <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate') }}" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all">
                        @error('birthdate')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Weight Size -->
                    <div>
                        <label for="weightSize" class="block text-sm font-semibold text-gray-700 mb-2">Size *</label>
                        <select name="weightSize" id="weightSize" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all appearance-none bg-white"
                            style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em 1.5em;">
                            <option value="">Select Size</option>
                            <option value="S" {{ old('weightSize') == 'S' ? 'selected' : '' }}>Small (S)</option>
                            <option value="M" {{ old('weightSize') == 'M' ? 'selected' : '' }}>Medium (M)</option>
                            <option value="L" {{ old('weightSize') == 'L' ? 'selected' : '' }}>Large (L)</option>
                        </select>
                        @error('weightSize')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pet Photo -->
                    <div>
                        <label for="petPhoto" class="block text-sm font-semibold text-gray-700 mb-2">Pet Photo (Optional)</label>
                        <div class="relative">
                            <input type="file" name="petPhoto" id="petPhoto" accept="image/*"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Max size: 2MB</p>
                        @error('petPhoto')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Vaccination File -->
                    <div>
                        <label for="vaccinationFile" class="block text-sm font-semibold text-gray-700 mb-2">Vaccination File *</label>
                        <div class="relative">
                            <input type="file" name="vaccinationFile" id="vaccinationFile" accept=".pdf,.jpg,.jpeg,.png" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Upload vaccination records (PDF, JPG, PNG - Max 5MB)</p>
                        @error('vaccinationFile')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 mt-8 pt-6 border-t border-gray-100">
                    <button type="submit" class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-4 px-6 rounded-xl transition-all shadow-sm hover:shadow-md">
                        Add Pet
                    </button>
                    <a href="{{ route('customer.pets.index') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-4 px-6 rounded-xl text-center transition-all">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    @include('pets.partials.breed-script')
    <script>
        initBreedDropdown('petType', 'breed', 'customBreedContainer', 'customBreed', '{{ old('breed') }}');
    </script>
</x-customer-layout>
