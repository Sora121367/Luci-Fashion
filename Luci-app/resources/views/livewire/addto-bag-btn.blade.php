<div>
    <button 
       wire:click="addToBag"
       class="flex-1 bg-black hover:bg-gray-800 text-white py-3 px-6 rounded-lg font-medium transition shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
        Add to Bag
    </button>

    @if (session()->has('error'))
        <div class="text-red-600 mt-2 text-sm">{{ session('error') }}</div>
    @endif

    @if (session()->has('success'))
        <div class="text-green-600 mt-2 text-sm">{{ session('success') }}</div>
    @endif
</div>

