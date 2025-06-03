<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartModal extends Component
{
    public $showModal = false;
    public $title = 'Bags';
    public $totalPrice = 0;
    public $deliveryFee = 1.25;
    public $totalWithDelivery = 0;

    public $products = [];

    // Define listeners for incoming events
    protected $listeners = ['addToBagItem'];

    public function mount()
    {
        // Load cart data from session when component is initialized
        $this->products = session('cart_products', []);
        $this->calculateTotals();
    }

    private function calculateTotals()
    {
        $this->totalPrice = collect($this->products)->sum(function ($item) {
            $price = is_numeric($item['price']) ? (float) $item['price'] : 0;
            $quantity = is_numeric($item['quantity']) ? (int) $item['quantity'] : 0;

            return $price * $quantity;
        });

        $this->totalWithDelivery = $this->totalPrice + $this->deliveryFee;
    }

    // Updated method to ensure event broadcasting
    private function broadcastCartUpdate()
    {
        // Calculate totals before broadcasting
        $this->calculateTotals();

        // Dispatch event that can be received by any component
        $this->dispatch('cartUpdated', [
            'products' => $this->products,
            'totalPrice' => $this->totalPrice,
            'totalWithDelivery' => $this->totalWithDelivery,
        ]);
    }

    public function addToBagItem($productData)
    {
        logger('Adding to bag with size: ' . $productData['size']);

        // Fetch product from DB
        $product = Product::findOrFail($productData['product_id']);

        // Build item array
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

        // Get or create cart based on session ID
        $cart = Cart::firstOrCreate(
            ['session_id' => session()->getId()],
            [
                'id' => (string) Str::uuid(),
                'user_id' => Auth::id(), // Uncomment if using auth
            ]
        );

        // Check if item already exists in cart
        $existingItem = CartItem::where('cart_id', $cart->id)
            ->where('products_id', $product->id)
            ->where('size', $item['size'])
            ->first();

        if ($existingItem) {
            // Update quantity if item exists
            $existingItem->update([
                'quantity' => $existingItem->quantity + $item['quantity']
            ]);
        } else {
            // Create new cart item
            CartItem::create([
                'id' => (string) Str::uuid(),
                'cart_id' => $cart->id,
                'products_id' => $product->id,
                'size' => $item['size'],
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);
        }

        // Broadcast updated cart data to all listeners
        $this->broadcastCartUpdate();

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
        $this->syncCartWithDatabase();
        $this->showModal = false;
    }

    public function updateProduct($index)
    {
        if (!isset($this->products[$index])) {
            logger("Attempted to update non-existent product at index: $index");
            return;
        }

        $item = $this->products[$index];

        logger("Updated product in memory at index $index - Size: {$item['size']}, Quantity: {$item['quantity']}");

        // Update session
        session(['cart_products' => $this->products]);

        // Broadcast changes
        $this->broadcastCartUpdate();
    }

    public function removeProduct($index)
    {
        if (!isset($this->products[$index])) {
            logger("Attempted to remove non-existent product at index: $index");
            return;
        }

        $item = $this->products[$index];

        try {
            // Delete from DB
            $cart = Cart::where('session_id', session()->getId())->first();

            if ($cart) {
                $deleted = CartItem::where('cart_id', $cart->id)
                    ->where('products_id', $item['id'])
                    ->where('size', $item['size'])
                    ->delete();

                logger("Deleted $deleted items from database cart");
            }

            // Remove from session array
            unset($this->products[$index]);
            $this->products = array_values($this->products); // Reindex
            session(['cart_products' => $this->products]);

            // Broadcast updated cart data
            $this->broadcastCartUpdate();

            logger("Product at index $index removed. Remaining items: " . count($this->products));
        } catch (\Exception $e) {
            logger()->error("Failed to remove product: " . $e->getMessage());
            // You might want to notify the user here
        }
    }
    public function goToCheckout()
    {
        $this->syncCartWithDatabase(); // Make sure session is updated with latest sizes/quantities
        return redirect()->to('/checkout'); // Now redirect
    }


    public function syncCartWithDatabase()
    {
        $cart = Cart::firstOrCreate(
            ['session_id' => session()->getId()],
            ['id' => (string) Str::uuid()]
        );

        foreach ($this->products as $item) {
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('products_id', $item['id'])
                ->where('size', $item['size'])
                ->first();

            if ($cartItem) {
                $cartItem->update([
                    'quantity' => $item['quantity']
                ]);
                logger("Updated cart item in DB: {$item['name']} (Size: {$item['size']}) -> Quantity: {$item['quantity']}");
            } else {
                CartItem::create([
                    'id' => (string) Str::uuid(),
                    'cart_id' => $cart->id,
                    'products_id' => $item['id'],
                    'size' => $item['size'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
                logger("Inserted new cart item in DB: {$item['name']} (Size: {$item['size']}) -> Quantity: {$item['quantity']}");
            }
        }

        // Broadcast final cart state after sync
        $this->broadcastCartUpdate();
    }

    public function render()
    {
        return view('livewire.cart-modal'); //
    }
}
