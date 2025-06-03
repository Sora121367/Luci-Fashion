<div class=" p-4 rounded-md">
    <div class="flex flex-col space-y-2 mb-3">
        <div class="flex justify-between text-lg font-semibold">
            <p>Total</p>
            <p>US $ {{ number_format($totalPrice, 2) }}</p>
        </div>
        <div class="flex justify-between text-gray-500">
            <p>Delivery Fee</p>
            <p>US $ 1.25</p>
        </div>
    </div>
    <hr class="border-t border-gray-300 my-3">
    <div class="flex flex-col gap-4">
        <div class="flex justify-between text-lg font-semibold">
            <p>Amount</p>
            <p>US $ {{ number_format($totalWithDelivery, 2) }}</p>
        </div>
        <button wire:click='addProductOrder'
            class="bg-black text-white text-center py-3 px-10 rounded-md hover:bg-gray-800 transition">
            Checkout
        </button>
    </div>
</div>
