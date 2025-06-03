<?php

namespace App\Livewire;

use Livewire\Component;

class ProductCheckOut extends Component
{
    public $products = [];
    
    // Listen for cartUpdated event
    protected $listeners = ['cartUpdated' => 'updateProducts'];
    
    public function mount()
    {
        // Initialize from session data if available
        $sessionProducts = session('cart_products', []);
        if (!empty($sessionProducts)) {
            $this->products = $sessionProducts;
            logger('ProductCheckOut: Initialized with ' . count($this->products) . ' products from session');
        }
    }
    
    public function updateProducts($data)
    {
        // Log the received data for debugging
        logger('ProductCheckOut: Received cartUpdated event');
        
        // Safely access products in the data array
        if (is_array($data) && isset($data['products'])) {
            $this->products = $data['products'];
            logger('ProductCheckOut: Updated with ' . count($this->products) . ' products');
        } else {
            logger('ProductCheckOut: Received invalid data format in cartUpdated event');
        }
    }
    
    public function render()
    {
        return view('livewire.product-check-out', [
            'products' => $this->products
        ]);
    }
}