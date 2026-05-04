<x-admin-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto">
            <div class="mb-6 flex items-center gap-3">
                <a href="{{ route('rooms.show', $room->roomID) }}" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Edit Room {{ $room->roomNum }}</h1>
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

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <form action="{{ route('rooms.update', $room->roomID) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

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
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Room ID</td>
                                    <td class="px-6 py-4">
                                        <input type="text" value="{{ $room->roomID }}" disabled
                                               class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50 text-gray-500">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Room Type <span class="text-red-500">*</span></td>
                                    <td class="px-6 py-4">
                                        <select name="roomTypeID" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 @error('roomTypeID') border-red-500 @enderror">
                                            <option value="">Select Room Type</option>
                                            @foreach($roomTypes as $roomType)
                                                <option value="{{ $roomType->roomTypeID }}" {{ old('roomTypeID', $room->roomTypeID) == $roomType->roomTypeID ? 'selected' : '' }}>
                                                    {{ $roomType->typeName }} - Max {{ $roomType->maxCapacity }} pets - ₱{{ number_format($roomType->pricePerNight, 2) }}/night
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Room Number <span class="text-red-500">*</span></td>
                                    <td class="px-6 py-4">
                                        <input type="text" name="roomNum" value="{{ old('roomNum', $room->roomNum) }}" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 @error('roomNum') border-red-500 @enderror">
                                    </td>
                                </tr>
                                @if($room->roomPhoto)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Current Photo</td>
                                    <td class="px-6 py-4">
                                        <img src="{{ asset('storage/' . $room->roomPhoto) }}" alt="Room {{ $room->roomNum }}" class="w-24 h-24 object-cover rounded-lg border border-gray-200">
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Room Photo</td>
                                    <td class="px-6 py-4">
                                        <input type="file" name="roomPhoto" accept="image/*"
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                        <p class="text-xs text-gray-500 mt-1">Leave empty to keep current. Max 2MB.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Status <span class="text-red-500">*</span></td>
                                    <td class="px-6 py-4">
                                        <select name="status" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                                            <option value="Available" {{ old('status', $room->status) == 'Available' ? 'selected' : '' }}>Available</option>
                                            <option value="Occupied" {{ old('status', $room->status) == 'Occupied' ? 'selected' : '' }}>Occupied</option>
                                            <option value="Maintenance" {{ old('status', $room->status) == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                        <a href="{{ route('rooms.show', $room->roomID) }}"
                           class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded">
                            Update Room
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
