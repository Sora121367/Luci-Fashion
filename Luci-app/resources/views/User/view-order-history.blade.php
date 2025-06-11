<x-layout>
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Order history</h1>
            <p class="text-gray-600">Check the status of recent orders, manage returns, and discover similar products.
            </p>
        </div>

        <!-- Order 1 -->
        @foreach ($orders as $order)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                <!-- Order Header -->
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="grid grid-cols-4 gap-4 text-sm">
                            <div>
                                <p class="text-gray-500 font-medium">Order ID</p>
                                <p class="text-gray-900">{{ $order->id }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 font-medium">Date placed</p>
                                <p class="text-gray-900">{{ $order->created_at->format('F j, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 font-medium">Total amount</p>
                                <p class="text-gray-900">${{ $order->total_price }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 font-medium">Status</p>
                                <p class="text-gray-900">{{ $order->status }}</p>
                            </div>
                        </div>
                        <div class="mt-4 sm:mt-0 flex space-x-3">
                            <button
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                View Order
                            </button>
                        </div>
                    </div>
                </div>

                @foreach ($order->items as $item)
                    <!-- Product 1 -->
                    <div class="px-6 py-6 border-b border-gray-200">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/' . $item->product->image_path) }}"
                                    alt="Micro Backpack" class="w-20 h-20 rounded-lg object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $item->product->name }}
                                        </h3>
                                        <p class="text-sm text-gray-600 leading-relaxed">
                                            {{ $item->product->description }}
                                        </p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-lg font-medium text-gray-900 ml-4">${{ $item->product->price }}
                                        </p>
                                        <p class="text-lg font-medium text-gray-900 ml-4">Size: {{ strtoupper($item->size) }}</p>
                                        <p class="text-lg font-medium text-gray-900 ml-4">qua. {{ $item->quantity }}</p>
                                    </div>


                                </div>
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center text-sm text-green-600">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Completed on {{$order->updated_at->format('F j, Y')}}
                                    </div>
                                    <div class="flex space-x-3">
                                        <a href="/show-product/{{$item->product->id}}">
                                            <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">View
                                            product</button>
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</x-layout>
