<div class="flex gap-4 md:gap-8">
    <div class="flex flex-col gap-y-3">
        @foreach ($images as $image)
            <img src="{{ asset('storage/' . $image) }}" alt="Related Product"
                class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-md hover:opacity-80 cursor-pointer transition"
                wire:click="changeMainImage('{{ $image }}')">
        @endforeach
    </div>

    <div>
        <img src="{{ asset('storage/' . $mainImage) }}" alt="Main Product"
            class="w-64 md:w-80 lg:w-96 object-cover rounded-lg shadow-sm">
    </div>
</div>
