<x-admin-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('payments.show', $payment->paymentID) }}" 
                       class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Payment</h1>
                </div>
                <p class="text-gray-600">Payment ID: #{{ $payment->paymentID }}</p>
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

            <!-- Edit Form -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Payment Information</h2>
                </div>

                <form action="{{ route('payments.update', $payment->paymentID) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <table class="w-full">
                        <tbody class="divide-y divide-gray-200">
                            <!-- Payment ID (Read-only) -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700 w-1/3">
                                    Payment ID
                                </td>
                                <td class="py-4">
                                    <input type="text" 
                                           value="{{ $payment->paymentID }}" 
                                           readonly
                                           class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
                                </td>
                            </tr>

                            <!-- Booking ID (Read-only) -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Booking ID
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center gap-2">
                                        <input type="text" 
                                               value="{{ $payment->bookingID }}" 
                                               readonly
                                               class="flex-1 px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed">
                                        <a href="{{ route('bookings.show', $payment->bookingID) }}" 
                                           class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-all text-sm font-medium">
                                            View Booking
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Payment Date -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Payment Date <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <input type="date" 
                                           name="paymentDate" 
                                           id="paymentDate"
                                           value="{{ old('paymentDate', $payment->paymentDate) }}"
                                           required
                                           class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                    @error('paymentDate')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <!-- Amount -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Amount <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold">₱</span>
                                        <input type="number" 
                                               name="amount" 
                                               id="amount"
                                               value="{{ old('amount', $payment->amount) }}"
                                               step="0.01"
                                               min="0"
                                               required
                                               class="w-full pl-8 pr-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                    </div>
                                    @error('amount')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                    @if($payment->booking)
                                        <p class="text-sm text-gray-500 mt-1">
                                            Booking Total: ₱{{ number_format($payment->booking->totalAmount, 2) }}
                                        </p>
                                    @endif
                                </td>
                            </tr>

                            <!-- Payment Method -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Payment Method <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <select name="paymentMethod" 
                                            id="paymentMethod"
                                            required
                                            class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                        <option value="">Select payment method</option>
                                        <option value="Cash" {{ old('paymentMethod', $payment->paymentMethod) === 'Cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="GCash" {{ old('paymentMethod', $payment->paymentMethod) === 'GCash' ? 'selected' : '' }}>GCash</option>
                                        <option value="Bank Transfer" {{ old('paymentMethod', $payment->paymentMethod) === 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                    </select>
                                    @error('paymentMethod')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <!-- Payment Status -->
                            <tr>
                                <td class="py-4 text-sm font-semibold text-gray-700">
                                    Payment Status <span class="text-red-500">*</span>
                                </td>
                                <td class="py-4">
                                    <select name="paymentStatus" 
                                            id="paymentStatus"
                                            required
                                            class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                        <option value="">Select payment status</option>
                                        <option value="Payment Complete" {{ old('paymentStatus', $payment->paymentStatus) === 'Payment Complete' ? 'selected' : '' }}>Payment Complete</option>
                                        <option value="Partially Paid" {{ old('paymentStatus', $payment->paymentStatus) === 'Partially Paid' ? 'selected' : '' }}>Partially Paid</option>
                                        <option value="Unpaid" {{ old('paymentStatus', $payment->paymentStatus) === 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                                    </select>
                                    @error('paymentStatus')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('payments.show', $payment->paymentID) }}" 
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
