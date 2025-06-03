<x-layout>
    <div class="flex p-4 mx-28 gap-4">
        {{-- Delivery Section --}}
        <div class="w-1/2 p-5">
            <h3 class="font-medium text-lg mb-3">Delivery address</h3>
            <div class="flex justify-between mb-2">
                <div class="flex gap-3">
                    <input type="checkbox" class="mt-1" />
                    <div class="flex flex-col">
                        <p class="font-medium">Uch Loemheng</p>
                        <p class="text-gray-600">Phnom Penh</p>
                        <p class="text-gray-600">078625718</p>
                    </div>
                </div>
                <div>
                    <button
                        class="text-blue-600 hover:underline flex items-center gap-2 py-2 text-left focus:outline-none">
                        <h3 class="text-sm">Change Address</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            <hr class="border-t border-gray-200 my-3">
            <div class="flex gap-3 p-3 bg-gray-50 rounded-md">
                <img src="web-images/black-logo.png" class="w-12 h-12 object-contain" alt="Black Logo">
                <div>
                    <p class="font-medium">Delivery : ${{ number_format($deliveryFee, 2) }}</p>
                    <p class="text-gray-600 text-sm">Luci Fashion(Delivery withing 1-3days)</p>
                </div>
            </div>
            {{-- <div class="py-4">
                <h1 class="font-medium text-lg mb-2">My shopping bag ({{ $cartItems->count() }})</h1>
                <ul class="py-4 grid grid-cols-1 gap-4 w-full">
                    @foreach ($cartItems as $item)
                        <x-checkout-card :src="$item->product->image_path" :price="$item->product->price" :info="$item->product->name" :id="$item->product->id"
                            :quantity="$item->quantity" :size="$item->size" />
                    @endforeach

                </ul>
            </div> --}}
            <livewire:product-check-out/>
        </div>

        {{-- Payment Section --}}
        <div class="w-1/2  p-5">
            <h3 class="py-3 font-medium text-lg">Payment</h3>
            <div class="flex gap-3 p-3 ">
                <input type="radio" name="payment" checked>
                <img src="{{ asset('web-images/aba.jpg') }}" class="h-8 rounded-md" alt="ABA Logo">
            </div>
            <div class="flex gap-3 p-3  mb-4">
                <input type="radio" name="payment">
                <img src="{{ asset('web-images/ac.jpg') }}" class="h-8 rounded-md" alt="AC Logo">
            </div>
            <div class="mb-4">
                <label for="note" class="block text-gray-700 mb-2">Note</label>
                <textarea id="note" name="note" rows="4" cols="50"
                    class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
            </div>
            <hr class="border-t border-gray-200 my-4">
            {{-- <div class=" p-4 rounded-md">
                <div class="flex flex-col space-y-2 mb-3">
                    <div class="flex justify-between text-lg font-semibold">
                        <p>Total</p>
                        <p>US $ {{ number_format($totalPrice, 2) }}</p>
                    </div>
                    <div class="flex justify-between text-gray-500">
                        <p>Delivery Fee</p>
                        <p>US $ {{ number_format($deliveryFee, 2) }}</p>
                    </div>
                </div>
                <hr class="border-t border-gray-300 my-3">
                <div class="flex flex-col gap-4">
                    <div class="flex justify-between text-lg font-semibold">
                        <p>Amount</p>
                        <p>US $ {{ number_format($totalWithDelivery, 2) }}</p>
                    </div>
                    <button class="bg-black text-white text-center py-3 px-10 rounded-md hover:bg-gray-800 transition">
                        Checkout
                    </button>
                </div>
            </div> --}}
            <livewire:check-out/>
        </div>
    </div>
</x-layout>
