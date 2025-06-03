@props(['price' => "Price", 'info' => "Details", 'id' => null])

<li class="p-2">
  {{$slot}}
  <a href="/show-product/{{ $id }}">
    <img src="{{$attributes->get('src')}}" alt="Product Image" class="w-full object-cover"/>
  </a>
  
  <div class="flex justify-between mx-2 pt-2">
    <!-- Left Side: Price & Details -->
    <div class="flex flex-col">
      <p class="text-lg font-semibold text-gray-700">$ {{ $price }}</p>
      <p class="text-sm text-gray-500">{{ $info }}</p>
    </div>

    <!-- Right Side: Favorite Button -->
    <livewire:favorite-button :productId='$id'/>
  </div>
</li>