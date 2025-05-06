<x-layout>
  <div class="flex flex-col md:flex-row py-8 px-4 md:py-16 md:px-8 lg:mx-16 xl:mx-32 gap-8 md:gap-16">
    {{-- Image Section --}}
    <div class="flex gap-4 md:gap-8">
      <div class="flex flex-col gap-y-3">
        <img src="{{ asset('product-images/related-prod-1.jpg') }}" alt="Related-Product 1" class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-md hover:opacity-80 cursor-pointer transition">
        <img src="{{ asset('product-images/related-prod-2.jpg') }}" alt="Related-Product 2" class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-md hover:opacity-80 cursor-pointer transition">
        <img src="{{ asset('product-images/related-prod-3.jpg') }}" alt="Related-Product 3" class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-md hover:opacity-80 cursor-pointer transition">
      </div>
      <img src="{{ asset($product['image_path']) }}" alt="Main Product" class="w-64 md:w-80 lg:w-96 object-cover rounded-lg shadow-sm">
    </div>
    
    {{-- Details Section --}}
    <div class="w-full md:w-1/2 space-y-6">
      {{-- Price and name --}}
      <div class="border-b border-gray-200 pb-4">
        <h3 class="text-2xl font-bold text-gray-800">{{ $product['price'] }}</h3>
        <p class="text-lg text-gray-700 mt-2">{{ $product['name'] }}</p>
      </div>
      
      {{-- Size --}}
      {{-- <div class="space-y-3">
        <h3 class="text-lg font-semibold text-gray-800">Size</h3>
        <div class="flex flex-wrap gap-3">
          <button class="w-10 h-10 rounded-full border-2 border-gray-300 hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">S</button>
          <button class="w-10 h-10 rounded-full border-2 border-gray-300 hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">M</button>
          <button class="w-10 h-10 rounded-full border-2 border-blue-500 bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">L</button>
          <button class="w-10 h-10 rounded-full border-2 border-gray-300 hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">XL</button>
          <button class="w-10 h-10 rounded-full border-2 border-gray-300 hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">XXL</button>
        </div>
      </div> --}}
      <livewire:size/>
      
      {{-- Quantity --}}
      {{-- <div class="space-y-3">
        <h3 class="text-lg font-semibold text-gray-800">Quantity</h3>
        <div class="flex items-center">
          <button class="w-10 h-10 flex items-center justify-center rounded-l-lg bg-gray-100 hover:bg-gray-200 border border-gray-300 text-xl font-medium ">-</button>
          <div class="w-12 h-10 flex items-center justify-center border-t border-b border-gray-300 bg-white text-gray-800">1</div>
          <button class="w-10 h-10 flex items-center justify-center rounded-r-lg bg-gray-100 hover:bg-gray-200 border border-gray-300 text-xl font-medium ">+</button>
        </div>
      </div> --}}
      <livewire:quantity/>
      
      {{-- Add to bag --}}
       <div class="flex gap-3 pt-3">
        {{-- <button wire:click="addToBagItem({{ $product }})" class="flex-1 bg-black hover:bg-gray-800 text-white py-3 px-6 rounded-lg font-medium transition shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
          Add to Bag
        </button>  --}}
        <livewire:addto-bag-btn :productId="$product->id" :image_path="$product->image_path"/>
        <button class="p-3 bg-gray-100 hover:bg-gray-200 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
          </svg>
        </button>
      </div>
      
      {{-- Product Details --}}
      <div class="mt-8 pt-4 border-t border-gray-200">
        <button class="w-full flex items-center justify-between py-2 text-left focus:outline-none group">
          <h3 class="text-lg font-semibold text-gray-800">Product Details</h3>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-hover:text-blue-500 transform transition-transform group-hover:rotate-180" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </button>
        <div class=" mt-3 text-gray-600">
          <p>{{$product['description']}}</p>

        </div>
      </div>
    </div>
  </div>
</x-layout>