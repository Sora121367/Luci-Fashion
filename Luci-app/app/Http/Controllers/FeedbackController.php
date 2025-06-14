<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $user = Auth::user();

        $completedOrdersCount = Order::where('user_id', $user->id)
            ->where('status', 'Completed')
            ->count();

        $ordersCount = Order::where('user_id', $user->id)->count();

        if ($ordersCount < 1 && $completedOrdersCount < 1) {
            return view('User.no-access-report');
        }

        return view('User.contact-us');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'reason' => 'required|string|in:Late Delivery,Damaged Products,Other',
            'comment' => 'required|string|min:10',
        ]);

        Feedback::create([
            'user_id' => Auth::id(), // dynamically get the logged-in user
            'title' => $request->title,
            'reason' => $request->reason,
            'comments' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Your report has been submitted.');
    }
}
