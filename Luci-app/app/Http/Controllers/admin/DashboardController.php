<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total statistics
        $totalSales = Order::sum('total_price');
        $totalUsers = User::count();
        $newUsersToday = User::whereDate('created_at', Carbon::today())->count();
        $totalProductsSold = OrderItem::sum('quantity');
        $totalPendingOrders = Order::where('status', 'Pending')->count();

        // Monthly sales data for bar chart
        $monthlySales = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->pluck('total', 'month');

        $salesData = [];
        for ($i = 1; $i <= 12; $i++) {
            $salesData[] = round($monthlySales->get($i, 0), 2);
        }

        return view('admin.dashboard', [
            'totalSales' => $totalSales,
            'totalUsers' => $totalUsers,
            'newUsersToday' => $newUsersToday,
            'totalProductsSold' => $totalProductsSold,
            'totalPendingOrders' => $totalPendingOrders,
            'salesData' => $salesData,
            'salesLabels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ]);
    }
}
