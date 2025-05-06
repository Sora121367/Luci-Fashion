<div class="space-y-3">
    <h3 class="text-lg font-semibold text-gray-800">Size</h3>
    <div class="flex flex-wrap gap-3">
        @foreach ($sizes as $option)
            <button 
                wire:click="chooseSize('{{ $option }}')" 
                class="w-10 h-10 rounded-full border-2 
                {{ $size === $option ? 'border-blue-500 bg-blue-50' : 'border-gray-300 hover:border-blue-500' }}">
                {{ $option }}
            </button>
        @endforeach
    </div>

    {{-- Show selected size --}}
    @if ($size)
        <p class="text-sm text-gray-600 mt-2">Selected size: <strong>{{ $size }}</strong></p>
    @endif

    {{-- Flash messages --}}
    @if (session()->has('error'))
        <div class="text-red-600 mt-2">{{ session('error') }}</div>
    @endif

    @if (session()->has('success'))
        <div class="text-green-600 mt-2">{{ session('success') }}</div>
    @endif
</div>
