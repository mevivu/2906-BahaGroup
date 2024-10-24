<?php

namespace App\Admin\Http\Controllers\Dashboard;

use App\Admin\Http\Controllers\Controller;
use App\Enums\Order\OrderStatus;
use App\Models\Order;
use App\Models\OrderDetail;

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

        $newCustomers = 32;
        $totalCustomers = 128;

        $totalProductsSold = OrderDetail::whereHas('order', function ($query) {
            $query->where('status', OrderStatus::Confirmed);
        })->sum('qty');

        $canceledOrders = Order::where('status', OrderStatus::Cancelled)->count();
        $cancelRate = $totalOrders > 0 ? ($canceledOrders / $totalOrders) * 100 : 0;

        $averageOrderValue = $completedOrders > 0
            ? $totalRevenue / $completedOrders
            : 0;

        $months = ['Tháng 1', 'Tháng 2', 'Tháng 3'];
        $monthlyRevenue = [10000000, 25000000, 13000000];

        return view($this->view['index'], compact(
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'totalRevenue',
            'newCustomers',
            'totalCustomers',
            'totalProductsSold',
            'cancelRate',
            'averageOrderValue',
            'months',
            'monthlyRevenue',
        ));
    }
}
