<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $userId = Auth::id(); // or use a specific user ID if needed
        $orders = Order::where('user_id', $userId)
            ->with('items.product')
            ->get();
        // dd($orders);
        return view('User.view-order-history',compact('orders'));
    }
}
