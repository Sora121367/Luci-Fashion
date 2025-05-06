<?php

namespace App\Livewire;

use Livewire\Component;

class Size extends Component
{
    public $size = null;
    public $sizes =["S","M","L","XL","XXL"];
    public function chooseSize($selectedSize)
    {
        if (!in_array($selectedSize, $this->sizes)) {
            session()->flash('error', "Invalid size selected.");
            return;
        }
    
        $this->size = $selectedSize;
        $this->dispatch('sizeSelected',size:$this->size);
        session()->flash('success', "You selected size: {$this->size}");
    }
    
    public function render()
    {
        return view('livewire.size');
    }
}
