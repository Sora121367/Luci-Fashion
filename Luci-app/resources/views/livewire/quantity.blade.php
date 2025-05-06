{{-- Quantity --}}
<div class="space-y-3">
    <h3 class="text-lg font-semibold text-gray-800">Quantity</h3>
    <div class="flex items-center">
        <button wire:click="decrement"class="w-10 h-10 flex items-center justify-center rounded-l-lg bg-gray-100 hover:bg-gray-200 border border-gray-300 text-xl font-medium ">-</button>
        <div class="w-12 h-10 flex items-center justify-center border-t border-b border-gray-300 bg-white text-gray-800">{{$quantity}}</div>
        <button wire:click="increment" class="w-10 h-10 flex items-center justify-center rounded-r-lg bg-gray-100 hover:bg-gray-200 border border-gray-300 text-xl font-medium ">+</button>
        @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-2">
            {{ session('error') }}
        </div>
        @endif
    </div>
</div>