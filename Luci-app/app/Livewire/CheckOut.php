<?php

namespace App\Livewire;

use App\Notifications\OrderCompleted;
use Livewire\Component;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class CheckOut extends Component
{
    public $totalPrice = 0;
    public $totalWithDelivery = 0;
    public $products = [];

    protected $listeners = ['cartUpdated' => 'updateTotals'];

    public function mount()
    {
        // Initialize from session data if available
        $sessionProducts = session('cart_products', []);
        if (!empty($sessionProducts)) {
            $this->products = $sessionProducts;
            logger('ProductCheckOut: Initialized with ' . count($this->products) . ' products from session');
            $this->totalPrice = collect($this->products)->sum(fn($item) => $item['price'] * $item['quantity']);
            $this->totalWithDelivery = $this->totalPrice + 1.25;
        }
    }

    public function updateTotals($data)
    {
        $this->totalPrice = $data['totalPrice'];
        $this->totalWithDelivery = $data['totalWithDelivery'];
    }
    public function addProductOrder()
    {
        $this->products = session('cart_products', []);
        // Get or create cart based on session ID
        $order = Order::firstOrCreate(
            [
                'session_id' => session()->getId(),
                'id' => (string) Str::uuid(),
                'total_price' => $this->totalWithDelivery,
                'payment_method' => 'Cash',
                'status' => 'Pending',
                'user_id' => Auth::id(),
            ]
        );


        // Create new order item
        foreach ($this->products as $product) {
            OrderItem::create([
                'id' => (string) Str::uuid(),
                'order_id' => $order->id,
                'products_id' => $product['id'],
                'size' => $product['size'],
                'status' => 'Pending',
                'quantity' => $product['quantity'],
                'price' => $product['price'],
            ]);
        }



        // Notify user if order is completed
        if ($order->status == 'Pending') {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $user->notify(new OrderCompleted($order));
            $admins = \App\Models\Admin::all();

            foreach ($admins as $admin) {
                $admin->notify(new OrderCompleted($order));
            }
        }


        // 🧹 Clear the cart after successful checkout
        $this->clearCart();

        // Optional: redirect or show success message
        session()->flash('success', 'Order placed successfully!');
        return redirect()->route('home');
    }

    private function clearCart()
    {
        // 1. Remove session cart
        session()->forget('cart_products');

        // 2. Delete cart items from database
        $cart = Cart::where('session_id', session()->getId())->first();

        if ($cart) {
            $cart->items()->delete(); // delete related cart items
            $cart->delete(); // delete the cart itself
        }

        // 3. Reset local component state (optional)
        $this->products = [];
        $this->totalPrice = 0;
        $this->totalWithDelivery = 0;
    }



    public function render()
    {
        return view('livewire.check-out');
    }
}
