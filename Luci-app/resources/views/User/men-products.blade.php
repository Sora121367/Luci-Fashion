
<x-layout>
  <div class="p-4 py-16 mx-28 flex gap-2">
    <h3 class="text-2xl">Men(12 items)</h3>
    <img src="{{ asset('filter.jpg') }}" alt="Filter Image">
  </div>
  <div class="p-4 mx-28">
    <h1 class="text-4xl font-extrabold pb-4">Clothing</h1>
  </div>
  <div class="p-4 mx-28">
    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($products as $product)
            <x-card src="{{$product['src']}}" 
            :price="$product['price']" 
            :info="$product['info']" 
            :id="$product['id']"
            ></x-card>
        @endforeach
    </ul>
  </div>

  <div class="p-4 mx-28">
    <h1 class="text-4xl font-extrabold pb-4">Shirts</h1>
  </div>
  <div class="p-4 mx-28">
    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($products as $product)
            <x-card src="{{$product['src']}}"></x-card>
        @endforeach
    </ul>
 </div>
  <div class="p-4 mx-28">
    <h1 class="text-4xl font-extrabold pb-4">Pants</h1>
  </div>
  <div class="p-4 mx-28">
    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($products as $product)
            <x-card src="{{$product['src']}}"></x-card>
        @endforeach
    </ul>
  </div>
  
</x-layout>

