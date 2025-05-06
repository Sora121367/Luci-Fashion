@props(['price' => "Price", 'info' => "Details", 'id' => null])

<li >
    {{$slot}}

    <div class="flex items-center gap-4">
      <!-- Product Image -->
      <a href="/show-product/{{ $id }}" class="w-40 h-40 flex-shrink-0">
          <img src="{{ $attributes->get('src') }}" alt="Product Image" class="w-full h-full object-cover rounded-lg"/>
      </a>
  
      <!-- Product Details (Wrap button inside this div) -->
      <div class="relative flex flex-1 flex-col space-y-2 pt-6 md:pt-8">
          <p class="text-lg text-gray-600">{{ $info }}</p>
          <p class="text-xl font-semibold text-red-600">{{ $price }}</p>
          <p class="text-md font-medium text-gray-700">Size: M</p>
          <p class="text-md font-medium text-gray-700">Quantity: 1</p>
  
          <!-- Delete Button (Inside Product Details, stays in top-right) -->
          <button class="absolute top-2 right-2 md:top-4 md:right-4 p-1 rounded-full hover:bg-gray-200 transition">
              <img src="{{ asset('web-images/delete.png') }}" alt="Remove" class="w-5 h-5"/>
          </button>
      </div>
  </div>
  
  
  
</li>
