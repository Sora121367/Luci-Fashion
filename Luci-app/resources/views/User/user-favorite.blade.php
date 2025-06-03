<x-layout>
    <div class="p-4 mx-28">
        @if (count($favorites) > 0)
            <ul class="grid grid-cols-1 gap-10 md:grid-cols-3 md:gap-4">
                @foreach ($favorites as $favorite)
                    @php $product = $favorite->product; @endphp

                    @if ($product)
                        <x-favorite-card src="{{ $product->image_path }}" :price="$product->price" :info="$product->name"
                            :id="$product->id" />
                    @endif
                @endforeach

            </ul>
        @else
            <div class="flex flex-col items-center justify-center h-60">
                <h1 class="text-3xl font-bold py-8">Your Favorite list is empty</h1>
                <p class="text-lg text-gray-600">Check our product and go to shopping</p>
                <a href="/user-home" class="mt-15 px-10 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition">
                    Shop Now
                </a>
            </div>
        @endif
    </div>
</x-layout>
