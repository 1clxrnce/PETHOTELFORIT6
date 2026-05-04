<x-admin-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Add Room</h1>
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
                <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
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
                                <!-- Room ID -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Room ID
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="text" 
                                               value="Auto-assigned"
                                               disabled
                                               class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50 text-gray-500">
                                    </td>
                                </tr>

                                <!-- Room Type ID -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Room Type <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select name="roomTypeID" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 @error('roomTypeID') border-red-500 @enderror">
                                            <option value="">Select Room Type</option>
                                            @foreach($roomTypes as $roomType)
                                                <option value="{{ $roomType->roomTypeID }}" {{ old('roomTypeID') == $roomType->roomTypeID ? 'selected' : '' }}>
                                                    {{ $roomType->typeName }} - Max {{ $roomType->maxCapacity }} pets - ₱{{ number_format($roomType->pricePerNight, 2) }}/night
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>

                                <!-- Room Number -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Room Number <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="text" 
                                               name="roomNum" 
                                               value="{{ old('roomNum') }}"
                                               required
                                               placeholder="e.g., 101, A-1, Suite-201"
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 @error('roomNum') border-red-500 @enderror">
                                    </td>
                                </tr>

                                <!-- Room Photo -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Room Photo
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="file" 
                                               name="roomPhoto" 
                                               accept="image/*"
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                        <p class="text-xs text-gray-500 mt-1">Max size: 2MB</p>
                                    </td>
                                </tr>

                                <!-- Status -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Status <span class="text-red-500">*</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select name="status" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                                            <option value="">Select Status</option>
                                            <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Available</option>
                                            <option value="Occupied" {{ old('status') == 'Occupied' ? 'selected' : '' }}>Occupied</option>
                                            <option value="Maintenance" {{ old('status') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Action Buttons -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                        <a href="{{ route('rooms.index') }}" 
                           class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded">
                            Back
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded">
                            Save Room
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
