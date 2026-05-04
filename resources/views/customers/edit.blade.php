<x-admin-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow p-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Customer</h1>

                @if($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('customers.update', $customer->cusID) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 mb-1">First Name *</label>
                            <input type="text" name="cusFName" value="{{ old('cusFName', $customer->cusFName) }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-1">Middle Name</label>
                            <input type="text" name="cusMName" value="{{ old('cusMName', $customer->cusMName) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-1">Last Name *</label>
                            <input type="text" name="cusLName" value="{{ old('cusLName', $customer->cusLName) }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-1">Phone Number *</label>
                            <input type="text" name="phoneNum" value="{{ old('phoneNum', $customer->phoneNum) }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-1">Email *</label>
                            <input type="email" name="email" value="{{ old('email', $customer->email) }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-1">Address</label>
                            <textarea name="address" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('address', $customer->address) }}</textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('customers.show', $customer->cusID) }}" 
                           class="text-gray-600 hover:text-gray-900">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                            Update Customer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
