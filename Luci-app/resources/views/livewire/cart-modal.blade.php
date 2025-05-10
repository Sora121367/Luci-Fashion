<div>
    <button wire:click="openModal">
        <img src="{{ asset('web-images/shopping-bag.jpg') }}" alt="Shopping Bag" class="w-8 h-8">
    </button>

    @if($showModal)
    <div class="fixed inset-0 flex justify-end z-50 ">
        <!-- Modal backdrop -->
        <div class="fixed inset-0 bg-black opacity-50" wire:click="closeModal"></div>
    
        <!-- Modal content (right side, 30% width) -->
        <div class="relative bg-white h-full w-[30%] rounded-l-lg shadow-lg z-10 overflow-y-auto">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-lg font-medium">{{ $title }}</h3>
                <button class="text-gray-500 hover:text-gray-700" wire:click="closeModal">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal body -->
            <div class="p-4">
                @if (count($products) == 0)
                    <div class="text-center space-y-6">
                        <div>
                            <h1 class="text-lg font-semibold">Your bag is empty</h1>
                            <p>Check our products and go shopping!</p>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <a href="/men-products" class="w-full">
                                <div class="bg-black text-white px-6 py-3 text-center rounded-lg w-full">Shop Men</div>
                            </a>
                            <a href="/women-products" class="w-full">
                                <div class="bg-black text-white px-6 py-3 text-center rounded-lg w-full">Shop Women</div>
                            </a>
                        </div>
                    </div>
                @else
                    <ul class="flex flex-col gap-4">
                        @foreach ($products as $index => $product)
                        <li wire:key="product-{{ $index }}" class="relative border rounded-lg p-3">
                            <div class="flex gap-3">
                                <img src="{{ asset(str_replace('\\', '/', $product['image_path'])) }}" alt="" class="w-[150px] h-[180px] object-cover rounded">
                                <div class="flex-1 space-y-2">
                                    <p class="text-lg font-semibold"> {{$product['name']}}</p>
                                    <p class="text-gray-600">US ${{$product['price']}}</p>
                                    
                                    <div class="flex justify-between gap-4 mt-2">
                                        <div>
                                            <label for="size-{{ $index }}" class="block text-sm font-medium">Size</label>
                                            <select id="size-{{ $index }}" name="size" wire:model.live="products.{{ $index }}.size" class="border px-2 py-1 rounded focus:outline-none focus:ring w-full">
                                                <option value="s">S</option>
                                                <option value="m">M</option>
                                                <option value="l">L</option>
                                                <option value="xl">XL</option>
                                                <option value="xxl">XXL</option>
                                            </select>
                                            
                                        </div>
                                        <div>
                                            <label for="quantity-{{ $index }}" class="block text-sm font-medium">Quantity</label>
                                            <input id="quantity-{{ $index }}" type="number" min="1" wire:model.live="products.{{ $index }}.quantity" class="border px-2 py-1 rounded w-full focus:outline-none focus:ring">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Remove button -->
                            <button wire:click="removeProduct({{ $index }})" class="absolute top-2 right-2">
                                <img src="{{ asset('web-images/delete.png') }}" alt="Remove" class="w-6 h-6 hover:opacity-70 transition">
                            </button>
                        </li>
                        @endforeach
                    </ul>
                    <hr class="border-t border-gray-300 my-3">
                    <div class="flex flex-col space-y-2 mb-3">
                        <div class="flex justify-between text-lg font-semibold">
                          <p>Total</p>
                          <p>US $ </p>
                        </div>
                        <div class="flex justify-between text-gray-500">
                          <p>Delivery Fee</p>
                          <p>US $ 1.25</p>
                        </div>
                      </div>
                      <hr class="border-t border-gray-300 my-3">
                      <div class="flex flex-col gap-4">
                        <div class="flex justify-between text-lg font-semibold">
                          <p>Amount</p>
                          <p>US $ </p>
                        </div>
                        <button class="bg-black text-white text-center py-3 px-10 rounded-md hover:bg-gray-800 transition">
                          <a href="/checkout">Proceed to Checkout</a>
                        </button>
                      </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>