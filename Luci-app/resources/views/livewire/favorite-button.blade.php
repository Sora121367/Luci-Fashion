<div>
    <button wire:click="toggleFavorite">
        <i class="text-2xl text-black {{ $isFavorited ? 'bi bi-heart-fill' : 'bi bi-heart' }}"></i>
    </button>
</div>
