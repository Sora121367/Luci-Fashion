<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Session;


class CheckoutController extends Controller
{

    public function index()
    {
        // Get cart products from session
        $cartProducts = Session::get('cart_products', []);

        // Calculate totals (same logic as in Livewire)
        $totalPrice = collect($cartProducts)->sum(function ($item) {
            return ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
        });

        $deliveryFee = 1.25; // Match your Livewire component
        $totalWithDelivery = $totalPrice + $deliveryFee;

        // Get cart items from DB (if needed)
        $cart = Cart::where('session_id', session()->getId())->first();
        $cartItems = $cart ? $cart->items()->with('product')->get() : collect();
        // dd($cartItems);

        return view('User.checkout', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'deliveryFee' => $deliveryFee,
            'totalWithDelivery' => $totalWithDelivery,
        ]);
    }
}
