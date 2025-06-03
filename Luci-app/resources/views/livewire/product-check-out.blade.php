<div class="py-4">
    <h1 class="font-medium text-lg mb-2">My shopping bag ({{ count($products) }})</h1>
    <ul class="py-4 grid grid-cols-1 gap-4 w-full">
        @foreach ($products as $product)
            <x-checkout-card :src="$product['image_path']" :price="$product['price']" :info="$product['name']" :id="$product['id']"
                :quantity="$product['quantity']" :size="$product['size']" />
        @endforeach
    </ul>
</div>
