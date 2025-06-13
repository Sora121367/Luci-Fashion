<div class="p-4 mx-28">
    @if($products->isEmpty())
        <p>No products found for selected filters.</p>
    @else
        <div>
            <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($products as $product)
                    <x-card 
                        src="{{ asset('storage/' . $product->image_path) }}"
                        :price="$product->price"
                        :info="$product->name"
                        :id="$product->id" />
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
