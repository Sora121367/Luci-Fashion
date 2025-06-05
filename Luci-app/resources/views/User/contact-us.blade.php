<x-layout>
    <div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Report a Problem</h1>
            <p class="text-gray-600">Let us know about any issues you've experienced with your order.</p>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <form action="{{ route('report-submit') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Problem Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Problem Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" required value="{{ old('title') }}"
                        placeholder="Brief description of the problem"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Reason Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        Reason for Report <span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-3">
                        <!-- Late Delivery -->
                        <div class="flex items-center">
                            <input id="late-delivery" name="reason" type="radio" value="Late Delivery"
                                {{ old('reason') == 'Late Delivery' ? 'checked' : '' }}
                                class="h-4 w-4 text-blue-600 border-gray-300">
                            <label for="late-delivery" class="ml-3 text-sm text-gray-700">Late Delivery</label>
                        </div>

                        <!-- Damaged Products -->
                        <div class="flex items-center">
                            <input id="damaged-products" name="reason" type="radio" value="Damaged Products"
                                {{ old('reason') == 'Damaged Products' ? 'checked' : '' }}
                                class="h-4 w-4 text-blue-600 border-gray-300">
                            <label for="damaged-products" class="ml-3 text-sm text-gray-700">Damaged Products</label>
                        </div>

                        <!-- Other -->
                        <div class="flex items-start">
                            <input id="other-reason" name="reason" type="radio" value="Other"
                                {{ old('reason') == 'Other' ? 'checked' : '' }}
                                class="h-4 w-4 text-blue-600 border-gray-300 mt-1">
                            <div class="ml-3 flex-1">
                                <label for="other-reason" class="text-sm text-gray-700 block mb-2">
                                    Other
                                </label>
                                <input type="text" id="other-input" name="other_reason"
                                    value="{{ old('other_reason') }}" placeholder="Please specify your reason"
                                    {{ old('reason') == 'other' ? '' : 'disabled' }}
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 {{ old('reason') == 'other' ? '' : 'bg-gray-100 cursor-not-allowed' }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comment Field -->
                <div>
                    <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
                        Additional Comments <span class="text-red-500">*</span>
                    </label>
                    <textarea id="comment" name="comment" rows="5" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 resize-vertical"
                        placeholder="Include order numbers, dates, etc.">{{ old('comment') }}</textarea>
                    <p class="mt-2 text-sm text-gray-500">Minimum 10 characters required</p>
                </div>

                <!-- Submit Button -->
                <div class="pt-6 border-t border-gray-200">
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                        Submit Report
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Section -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Need immediate assistance?</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>Contact our support team:</p>
                        <ul class="mt-1 list-disc list-inside">
                            <li>Phone: 1-800-SUPPORT</li>
                            <li>Email: support@company.com</li>
                            <li>Live Chat: 24/7 on our website</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
