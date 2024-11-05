<?php

namespace App\Admin\Http\Controllers\Dashboard;

use App\Admin\Http\Controllers\Controller;
use App\Enums\Order\OrderStatus;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //

    public function getView()
    {
        return [
            'index' => 'admin.dashboard.index'
        ];
    }
    public function index()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', OrderStatus::Pending)->count();
        $completedOrders = Order::where('status', OrderStatus::Confirmed)->count();
        $totalRevenue = Order::where('status', OrderStatus::Confirmed)->sum('total');
        $totalCustomers = User::count();

        $newCustomers = User::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        $newCustomersThisYear = User::whereYear('created_at', Carbon::now()->year)->count();

        $currentYear = Carbon::now()->year;

        // Generate an array for the last 12 months
        $months = [];
        for ($i = 0; $i < 12; $i++) {
            $months[] = Carbon::now()->startOfYear()->addMonths($i)->format('M');
        }

        // Get monthly revenue
        $monthlyRevenue = [];
        foreach ($months as $month) {
            $monthlyRevenue[] = Order::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', Carbon::parse($month)->month)
                ->where('status', OrderStatus::Confirmed)
                ->sum('total');
        }

        $totalProductsSold = OrderDetail::whereHas('order', function ($query) {
            $query->where('status', OrderStatus::Confirmed);
        })->sum('qty');

        $cancelledOrders = Order::where('status', OrderStatus::Cancelled)->count();
        $cancelRate = $totalOrders > 0 ? ($cancelledOrders / $totalOrders) * 100 : 0;

        $averageOrderValue = $completedOrders > 0
            ? $totalRevenue / $completedOrders
            : 0;

        $returningCustomersCount = Order::select('user_id')
            ->groupBy('user_id')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('user_id')
            ->count();

        // Calculate returning customer rate
        $returningCustomerRate = ($totalCustomers > 0)
            ? ($returningCustomersCount / $totalCustomers) * 100
            : 0;

        $averageItemsPerOrder = $completedOrders > 0
            ? OrderDetail::whereHas('order', fn($query) => $query->where('status', OrderStatus::Confirmed))
            ->sum('qty') / $completedOrders
            : 0;

        $totalDiscountGiven = Order::where('status', OrderStatus::Confirmed)
            ->sum('discount_value');

        $months = [];
        for ($i = 0; $i < 12; $i++) {
            $months[] = 'Tháng ' . Carbon::now()->startOfYear()->addMonths($i)->month;
        }

        return view($this->view['index'], compact(
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'cancelledOrders',
            'totalRevenue',
            'newCustomers',
            'totalCustomers',
            'totalProductsSold',
            'cancelRate',
            'averageOrderValue',
            'months',
            'monthlyRevenue',
            'totalDiscountGiven',
            'averageItemsPerOrder',
            'returningCustomerRate',
            'newCustomersThisYear'
        ));

        return view($this->view['index']);
    }
}
