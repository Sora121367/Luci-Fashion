<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartModal extends Component
{
    public $showModal = false;
    public $title = 'Bags';

    public $products = [];

    protected $listeners = ['addToBagItem'];

    public function mount()
    {
        // Load cart data from session when component is initialized
        $this->products = session('cart_products', []);
    }

    // public function addToBagItem($product)
    // {
    //     // Debug logging
    //     logger('Adding to bag with size: ' . $product['size']);
        
    //     // Add the new product
    //     $this->products[] = $product;
        
    //     // Save to session for persistence
    //     session(['cart_products' => $this->products]);
        
    //     // After adding, check what's in the array
    //     logger('Cart products: ' . json_encode($this->products));
    // }
    public function addToBagItem($productData)
    {   
    logger('Adding to bag with size: ' . $productData['size']);

    // Fetch product from DB
    $product = Product::findOrFail($productData['product_id']);

    // Build item array (session only stores what's needed)
    $item = [
        'id' => $product->id,
        'size' => $productData['size'],
        'quantity' => $productData['quantity'] ?? 1,
        'image_path' => $product->image_path,
        'price' => $product->price,
        'name' => $product->name,
    ];

    // Save to session
    $this->products[] = $item;
    session(['cart_products' => $this->products]);

    // Create or get cart
    $cart = Cart::firstOrCreate(
        [
            // 'user_id' => Auth::id(),
            'id' => (string) Str::uuid(),
            'session_id' => session()->getId(),
        ]
    );

    // Save to database
    if (isset($product->id)) {
        CartItem::create([
            'id' => (string) Str::uuid(),
            'cart_id' => $cart->id,
            'products_id' => $product->id,
            'size' => $item['size'],
            'quantity' => $item['quantity'],
            'price' => $product->price, // from DB
        ]);
    } else {
        // Handle error: product_id is missing
        logger('Product ID is missing for CartItem creation');
    }


    logger('Cart updated: ' . json_encode($this->products));
    }

    public function getProductQuantityProperty()
    {
        // Live calculation of product quantity
        return count($this->products);
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function removeProduct($index)
    {
        // Remove product at given index
        unset($this->products[$index]);

        // Reindex array to prevent Livewire reactivity issues
        $this->products = array_values($this->products);
        
        // Update session after removal
        session(['cart_products' => $this->products]);
    }

    public function render()
    {
        return view('livewire.cart-modal');
    }
}