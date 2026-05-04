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
                    <h1 class="text-3xl font-bold text-gray-900">Employee Details</h1>
                </div>
                <p class="text-gray-600">Employee ID: #{{ $employee->empID }}</p>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-green-800">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Employee Information Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Employee Information</h2>
                </div>
                
                <div class="p-6">
                    <table class="w-full">
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700 w-1/3">Employee ID</td>
                                <td class="py-3 text-sm text-gray-900">{{ $employee->empID }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">User ID</td>
                                <td class="py-3 text-sm text-gray-900">{{ $employee->userID }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Username</td>
                                <td class="py-3 text-sm text-gray-900">{{ $employee->user->username ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Role</td>
                                <td class="py-3 text-sm text-gray-900">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                                        @if($employee->user->role === 'Admin') bg-purple-100 text-purple-700
                                        @else bg-blue-100 text-blue-700
                                        @endif">
                                        {{ $employee->user->role ?? 'N/A' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Status</td>
                                <td class="py-3 text-sm text-gray-900">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                                        @if($employee->user->status === 'Active') bg-green-100 text-green-700
                                        @else bg-red-100 text-red-700
                                        @endif">
                                        {{ $employee->user->status ?? 'N/A' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">First Name</td>
                                <td class="py-3 text-sm text-gray-900">{{ $employee->empFName }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Middle Name</td>
                                <td class="py-3 text-sm text-gray-900">{{ $employee->empMName ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Last Name</td>
                                <td class="py-3 text-sm text-gray-900">{{ $employee->empLName }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Phone Number</td>
                                <td class="py-3 text-sm text-gray-900">{{ $employee->phoneNum }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Email</td>
                                <td class="py-3 text-sm text-gray-900">{{ $employee->email }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Birthdate</td>
                                <td class="py-3 text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($employee->birthdate)->format('F d, Y') }}
                                    <span class="text-gray-500 text-xs ml-2">
                                        ({{ \Carbon\Carbon::parse($employee->birthdate)->age }} years old)
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Gender</td>
                                <td class="py-3 text-sm text-gray-900">{{ $employee->gender }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Address</td>
                                <td class="py-3 text-sm text-gray-900">{{ $employee->address }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 text-sm font-semibold text-gray-700">Hire Date</td>
                                <td class="py-3 text-sm text-gray-900">
                                    @if($employee->hireDate)
                                        {{ \Carbon\Carbon::parse($employee->hireDate)->format('F d, Y') }}
                                        <span class="text-gray-500 text-xs ml-2">
                                            ({{ \Carbon\Carbon::parse($employee->hireDate)->diffForHumans() }})
                                        </span>
                                    @else
                                        <span class="text-gray-500">Not set</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Booking History Card -->
            @if($employee->bookings->count() > 0)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Booking History</h2>
                    <p class="text-green-100 text-sm">{{ $employee->bookings->count() }} bookings handled</p>
                </div>
                
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Booking ID</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pet</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Check-in</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Check-out</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($employee->bookings->take(10) as $booking)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-blue-600">
                                            <a href="{{ route('bookings.show', $booking->bookingID) }}" class="hover:underline">
                                                #{{ $booking->bookingID }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $booking->customer->cusFName ?? 'N/A' }} {{ $booking->customer->cusLName ?? '' }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $booking->pet->petName ?? 'N/A' }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($booking->checkInDate)->format('M d, Y') }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($booking->checkOutDate)->format('M d, Y') }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 py-1 text-xs font-semibold rounded
                                                @if($booking->status === 'Confirmed') bg-green-100 text-green-700
                                                @elseif($booking->status === 'Pending') bg-yellow-100 text-yellow-700
                                                @elseif($booking->status === 'Completed') bg-blue-100 text-blue-700
                                                @else bg-red-100 text-red-700
                                                @endif">
                                                {{ $booking->status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            ₱{{ number_format($booking->totalAmount, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if($employee->bookings->count() > 10)
                        <div class="mt-4 text-center">
                            <p class="text-sm text-gray-500">Showing 10 of {{ $employee->bookings->count() }} bookings</p>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <a href="{{ route('employees.edit', $employee->empID) }}" 
                   class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-lg text-center transition-all">
                    Edit Employee
                </a>
                <form action="{{ route('employees.destroy', $employee->empID) }}" method="POST" class="flex-1"
                      onsubmit="return confirm('Are you sure you want to delete this employee? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg transition-all">
                        Delete Employee
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>