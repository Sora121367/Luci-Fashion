<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    /**
     * Show the view for customer orders.
     */
    public function index()
    {
        return view('admin.customers');
    }

    /**
     * API: Get all customers with total orders and order sums.
     */
    public function getCustomers()
    {
        $customers = User::whereHas('orders')
            ->withCount('orders')
            ->withSum('orders', 'total_price')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'orders_count' => $user->orders_count,
                    'orders_total' => $user->orders_sum_total_price,
                    'status' => $user->status ?? null,
                ];
            });

        return response()->json($customers);
    }

    /**
     * API: Get all orders by a specific user, including order items and product info with image.
     */
    public function getOrdersByUser($userId)
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'status' => $order->status,
                    'total_price' => $order->total_price,
                    'payment_method' => $order->payment_method,
                    'items' => $order->items->map(function ($item) {
                        return [
                            'size' => $item->size,
                            'quantity' => $item->quantity,
                            'product' => [
                                'id' => $item->product->id,
                                'name' => $item->product->name,
                                'price' => $item->product->price,
                                'image_path' => asset('storage/' . $item->product->image_path), // Ensure correct public URL
                            ],
                        ];
                    }),
                ];
            });

        return response()->json($orders);
    }

    /**
     * API: Update the status of an order.
     */
 
    public function updateOrderStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|in:Pending,Accepted,Rejected,Completed',
        ]);

        $order = Order::findOrFail($orderId);
        $order->status = $request->status;
        $order->save();


        if (in_array($order->status, ['Accepted', 'Completed', 'Rejected', 'Pending'])) {
            if ($order->user) {
                $order->user->notify(new UserNotification($order));
            }
        }


        return response()->json(['message' => 'Order status updated successfully']);
    }
}