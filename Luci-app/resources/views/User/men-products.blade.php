<x-layout>
    <div class="p-4 py-16 mx-28 flex gap-2">
        <h3 class="text-2xl">Men({{ $totalProducts }} items)
        </h3>
        <livewire:filter :main-category="$name"/>
    </div>
    {{-- @foreach ($subCategories as $subCategory)
        <div class="p-4 mx-28">
            <h2 class="text-4xl font-extrabold pb-4">{{ $subCategory->name }}</h2>

            @if ($subCategory->products->isEmpty())
                <p>No products in this category.</p>
            @else
                <div>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($subCategory->products as $product)
                            <x-card src="{{ asset('storage/' . $product['image_path']) }}" :price="$product['price']"
                                :info="$product['name']" :id="$product['id']"></x-card>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endforeach --}}
    <livewire:product-list :main-category="$name" />
</x-layout>
