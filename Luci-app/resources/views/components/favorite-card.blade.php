@props(['price' => 'Price', 'info' => 'Details', 'id' => null, 'src' => '', 'size' => 'M', 'quantity' => 1])

<li class="relative rounded-lg bg-white shadow-sm overflow-hidden">
    <!-- Favorite Button (Top-Right of entire card) -->
    <div class="absolute top-4 right-4 z-20">
        @if ($id)
            <div class="p-1 rounded-full bg-white shadow-lg hover:bg-gray-50 transition-colors">
                <livewire:favorite-button :productId="$id" :key="$id" />
            </div>
        @endif
    </div>
    
    <div class="flex h-full">
        <!-- Product Image - Full Height -->
        <a href="/show-product/{{ $id }}" class="w-40 flex-shrink-0">
            <img src="{{ $src }}" alt="Product Image" class="w-full h-full object-cover" />
        </a>
        <!-- Product Details -->
        <div class="flex flex-1 flex-col justify-between p-4 pr-12">
            <div class="space-y-2">
                <p class="text-xl font-semibold text-gray-700">${{ $price }}</p>
                <p class="text-lg text-gray-600">{{ $info }}</p>
            </div>
            
            <div class="flex flex-col gap-4 mt-4">
                <div>
                    <label for="size-{{ $id }}" class="block text-sm font-medium mb-1">Size</label>
                    <select id="size-{{ $id }}" name="size"
                        class="border px-2 py-1 rounded focus:outline-none focus:ring w-full max-w-xs">
                        <option value="s" {{ $size === 'S' ? 'selected' : '' }}>S</option>
                        <option value="m" {{ $size === 'M' ? 'selected' : '' }}>M</option>
                        <option value="l" {{ $size === 'L' ? 'selected' : '' }}>L</option>
                        <option value="xl" {{ $size === 'XL' ? 'selected' : '' }}>XL</option>
                        <option value="xxl" {{ $size === 'XXL' ? 'selected' : '' }}>XXL</option>
                    </select>
                </div>
                <div>
                    <label for="quantity-{{ $id }}" class="block text-sm font-medium mb-1">Quantity</label>
                    <input id="quantity-{{ $id }}" type="number" min="1" value="{{ $quantity }}"
                        class="border px-2 py-1 rounded w-full max-w-xs focus:outline-none focus:ring">
                </div>
                <div>
                    <button class="border rounded-xl px-6 py-2 hover:bg-gray-50 transition-colors">
                        Move to bag
                    </button>
                </div>
            </div>
        </div>
    </div>
</li>