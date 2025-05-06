<?php

namespace App\Livewire;

use Livewire\Component;

class AddtobagBtn extends Component
{
    public $size;
    public $quantity = 1; // default
    public $productId;
    public $image_path;

    protected $listeners = ['sizeSelected', 'quantityUpdated'];

    public function mount($productId,$image_path){
        $this->productId = $productId;
        $this->image_path = $image_path;
        logger("Mounted with Product ID: " . $productId); // Or use dd($productId);
    }

    public function sizeSelected($size)
    {
        $this->size = $size;
    }

    public function quantityUpdated($quantity)
    {
        $this->quantity = $quantity;
    }

    public function addToBag()
    {
        if (!$this->size) {
            session()->flash('error', 'Please select a size.');
            return;
        }

        $this->dispatch('addToBagItem', [
            'quantity' => $this->quantity,
            'product_id' => $this->productId,// replace with actual product info
            'size' => strtolower($this->size),
            'image_path' => $this->image_path,
        ]);

        

        session()->flash('success', 'Item added to bag!');
    }

    public function render()
    {

        return view('livewire.addto-bag-btn');
    }
}
