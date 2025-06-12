<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\FavoriteProduct;
use Illuminate\Support\Facades\Auth;

class FavoriteButton extends Component
{
    public $productId;
    public $isFavorited = false;

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->isFavorited = $this->checkFavorite();
    }

    public function toggleFavorite()
    {
        if ($this->isFavorited) {
            $this->removeFavoriteProduct();
        } else {
            $this->addFavoriteProduct();
        }

        $this->isFavorited = !$this->isFavorited;
    }

    public function addFavoriteProduct()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        FavoriteProduct::firstOrCreate([
            'user_id' => Auth::id(),
            'session_id' => session()->getId(),
            'products_id' => $this->productId,
        ]);
    }

    public function removeFavoriteProduct()
    {
        // dd(session()->getId());
        FavoriteProduct::where('user_id', Auth::id())->first()
            ->where('products_id', $this->productId)
            ->delete();
    }

    private function checkFavorite()
    {
        return FavoriteProduct::where('user_id', Auth::id())
            ->where('products_id', $this->productId)
            ->exists();
    }

    public function render()
    {
        return view('livewire.favorite-button');
    }
}
