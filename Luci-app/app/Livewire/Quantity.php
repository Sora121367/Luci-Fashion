<?php

namespace App\Livewire;

use Livewire\Component;

class Quantity extends Component
{
    public $quantity = 1;

    public function increment (){
        $this->quantity += 1 ;
        $this->dispatch('quantityUpdated', quantity: $this->quantity);
    }
    public function decrement (){
        if($this->quantity > 1){
            $this->quantity -= 1;
            $this->dispatch('quantityUpdated', quantity: $this->quantity);
        }else{
            session()->flash('error', "Quantity can't be less than 1.");
        }
    }
    public function render()
    {
        return view('livewire.quantity');
    }
}
