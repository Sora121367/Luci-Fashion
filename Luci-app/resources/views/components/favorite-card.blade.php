@props(['price' => 'Price', 'info' => 'Details', 'id' => null, 'src' => '', 'size' => 'M', 'quantity' => 1])

<li>
    {{ $slot }}

    <div class="flex items-center gap-4">
        <!-- Product Image -->
        <a href="/show-product/{{ $id }}" class="w-40 h-40 flex-shrink-0">
            <img src="{{ $src }}" alt="Product Image" class="w-full h-full object-cover rounded-lg" />
        </a>

        <!-- Product Details (Wrap button inside this div) -->
        <div class="relative flex flex-1 flex-col space-y-2 pt-6 md:pt-8">
            <p class="text-xl font-semibold text-gray-700">{{ $price }}</p>
            <p class="text-lg text-gray-600">{{ $info }}</p>
            <div class="flex flex-col justify-between gap-4 mt-2">
                <div>
                    <label for="size" class="block text-sm font-medium">Size</label>
                    <select id="size" name="size"
                        class="border px-2 py-1 rounded focus:outline-none focus:ring w-full">
                        <option value="s">S</option>
                        <option value="m">M</option>
                        <option value="l">L</option>
                        <option value="xl">XL</option>
                        <option value="xxl">XXL</option>
                    </select>

                </div>
                <div>
                    <label for="quantity-  }}" class="block text-sm font-medium">Quantity</label>
                    <input id="quantity-  }}" type="number" min="1"
                        class="border px-2 py-1 rounded w-full focus:outline-none focus:ring">
                </div>
                <div>
                    <button class="border rounded-xl px-10">
                        Move to bag
                    </button>
                </div>
            </div>


            <!-- Delete Button (Inside Product Details, stays in top-right) -->
            <button class="absolute top-2 right-2 md:top-4 md:right-4 p-1 rounded-full hover:bg-gray-200 transition">
                <img src="{{ asset('web-images/delete.png') }}" alt="Remove" class="w-5 h-5" />
            </button>
        </div>
    </div>
</li>
