
<x-layout>
  <div class="p-4 mx-28">
    <img src="web-images/banner.jpg" alt="Banner Image" />
  </div>
  <div class="p-4 mx-28 flex items-center gap-5">
    <!-- Text Section -->
    <div class="w-1/2 ml-10">
      <h1 class="text-5xl font-extrabold pb-4">NEW <br>COLLECTIONS</h1>
      <button class="border p-4 bg-green-900 text-white text-xl">Shop Now</button>
    </div>
  
    <!-- Image Section -->
    <div class="w-1/2 mr-10">
      <img src="web-images/sample-model.jpg" alt="Sample Model Image" class="w-full h-auto object-cover">
    </div>
  </div>
  <div class="p-4 mx-28">
    <h1 class="text-5xl font-extrabold pb-4">NEW <br>THIS WEEK</h1>
  </div>
  <div class="p-4 mx-28">
    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($products as $product)
            <x-card src="{{ asset('storage/' . $product['image_path']) }}" 
            :price="$product['price']" 
            :info="$product['name']" 
            :id="$product['id']"
            ></x-card>
        @endforeach
    </ul>
  </div>

  <div class="p-4 mx-28">
    <h1 class="text-5xl font-extrabold pb-4">NEW PANTS</h1>
  </div>
  {{-- <div class="p-4 mx-28">
    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($products as $product)
            <x-card src="{{$product['src']}}"></x-card>
        @endforeach
    </ul>
 </div> --}}

  <div class="bg-black text-white flex justify-between p-4 w-full h-fit gap-10">
    <div class="p-4 mx-8 flex flex-col w-140 h-auto relative">
      <h3 class="py-4 text-3xl font-bold">Delivery & Returns</h3>
      <p class="py-4">
        To deliver your favorite products, we have partnered with the most reliable companies. We are ready to entrust them with your orders and are always<br> 
        on your side if something goes wrong.
      </p>
      <p class="py-4">
        We will be happy to assist you with eligible returns, the return instructions,<br> 
        and the shipping address. If you need a return or exchange, send us an<br> 
        email so we can discuss a replacement.
      </p>
    </div>
  
    <!-- Centered Text -->
    <div class="flex items-center">
      <p class="text-center mr-20">Free shipping on orders <br><u>of $50 or more</u></p>
    </div>
  </div>

  <div class="flex gap-10 py-20 px-40">
    <img src="web-images/location-image.jpg" alt="Location showcase Image">
    <div class="">
      <h3 class="text-2xl font-bold py-3">Location</h3>
      <p class="text-lg">
        Customers Can contact to us or buy our products at the store<br>
        located below.
      </p>
      <h3 class="text-xl font-bold py-4">Our Address</h3>
      <p class="text-lg">
        100E0 Street 118, Songkat Phsae Chas,<br> 
        Khan Doun Penh , Phnompenh
      </p>
      <a href="/location" class="py-2 text-green-900">Get directions</a>
      <h3 class="text-xl font-bold py-4">Contact Info</h3>
      <p class="text-lg">
        +855 78219291
      </p>
      <p>loemheng@gmail.com</p>
      <div class="flex gap-5 py-2">
        <a href="telegram.org">
          <img src="web-images/telegram-black.jpg" alt="Telegram Logo">
        </a>
        <a href="facebook.com">
          <img src="web-images/facebook-black.jpg" alt="Facebook Logo">
        </a>
      </div>
    </div>
  </div>
  
  
</x-layout>

