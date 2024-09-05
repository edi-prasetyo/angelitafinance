<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {

        $amountSum = OrderItem::selectRaw('sum(price)')
            ->whereColumn('order_id', 'orders.id')
            ->getQuery();

        $orders = Order::orderBy('order_date', 'DESC')
            ->where(['orders.cancel' => 1, 'status' => 1])
            ->with('payments')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('orders.*', 'customers.full_name as customer_name')
            ->selectSub($amountSum, 'amount_sum')
            ->with('orderCount')
            ->paginate(20);
        $order_today = OrderItem::whereDate('start_date', Carbon::today())->get();
        $order_yesterday = OrderItem::whereDate('start_date', Carbon::yesterday())->get();
        $order_tomorow = OrderItem::whereDate('start_date', Carbon::tomorrow())->get();

        $order_last_month = OrderItem::whereMonth(
            'start_date',
            '=',
            Carbon::now()->subMonth()->month
        )->get();

        $order_this_month = OrderItem::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
        $all_orders = OrderItem::all();

        // return $order_last_month;
        // return $orders;
        $get_total = $orders->sum('bill');
        $get_price = $orders->sum('amount_sum');
        return view('admin.reports.index', compact('orders', 'all_orders', 'get_total', 'get_price', 'order_today', 'order_yesterday', 'order_tomorow', 'order_last_month', 'order_this_month'));
    }
    public function card()
    {

        $amountSum = OrderItem::selectRaw('sum(price)')
            ->whereColumn('order_id', 'orders.id')
            ->getQuery();

        $orders = Order::orderBy('order_date', 'DESC')
            ->where(['orders.cancel' => 1, 'status' => 1])
            ->with('payments')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('orders.*', 'customers.full_name as customer_name')
            ->selectSub($amountSum, 'amount_sum')
            ->with('orderCount')
            ->paginate(20);
        $order_today = OrderItem::whereDate('start_date', Carbon::today())->get();
        $order_yesterday = OrderItem::whereDate('start_date', Carbon::yesterday())->get();
        $order_tomorow = OrderItem::whereDate('start_date', Carbon::tomorrow())->get();

        $order_last_month = OrderItem::whereMonth(
            'start_date',
            '=',
            Carbon::now()->subMonth()->month
        )->get();

        $order_this_month = OrderItem::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
        $all_orders = OrderItem::all();

        // return $order_last_month;
        // return $orders;
        $get_total = $orders->sum('bill');
        $get_price = $orders->sum('amount_sum');
        return view('admin.reports.card', compact('orders', 'all_orders', 'get_total', 'get_price', 'order_today', 'order_yesterday', 'order_tomorow', 'order_last_month', 'order_this_month'));
    }
    public function daily(Request $request)
    {
        $amountSum = OrderItem::selectRaw('sum(price)')
            ->whereColumn('id', 'order_items.id')
            ->getQuery();

        $date = $request['start_date'];
        $order_items = OrderItem::select('order_items.*', 'customers.full_name as customer_name', 'packages.name as package_name', 'cars.name as car_name', 'cars.number as car_number', 'users.name as driver_name')
            ->where('start_date', $date)
            ->join('customers', 'customers.id', '=', 'order_items.customer_id')
            ->join('users', 'users.id', '=', 'order_items.driver_id')
            ->join('packages', 'packages.id', '=', 'order_items.package_id')
            ->join('cars', 'cars.id', '=', 'order_items.car_id')
            // ->selectSub($amountSum, 'amount_sum')
            ->orderBy('id', 'desc')
            ->paginate(120);
        $order_today = OrderItem::whereDate('start_date', Carbon::today())->get();
        $order_yesterday = OrderItem::whereDate('start_date', Carbon::yesterday())->get();
        $order_tomorow = OrderItem::whereDate('start_date', Carbon::tomorrow())->get();

        $order_last_month = OrderItem::whereMonth(
            'start_date',
            '=',
            Carbon::now()->subMonth()->month
        )->get();

        $order_this_month = OrderItem::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
        $all_orders = OrderItem::all();

        // return $order_last_month;
        // return $orders;
        // $get_total = $order_items->sum('bill');
        $get_price = $order_items->sum('price');
        return view('admin.reports.daily', compact('order_items', 'all_orders', 'get_price', 'order_today', 'order_yesterday', 'order_tomorow', 'order_last_month', 'order_this_month'));
    }
    public function sales()
    {

        $amountSum = OrderItem::selectRaw('sum(price)')
            ->whereColumn('order_id', 'orders.id')
            ->getQuery();

        $orders = Order::orderBy('order_date', 'DESC')
            ->with('payments')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('orders.*', 'customers.full_name as customer_name')
            ->selectSub($amountSum, 'amount_sum')
            ->paginate(20);
        // return $orders;
        $get_total = $orders->sum('bill');
        $get_price = $orders->sum('amount_sum');
        return view('admin.reports.index', compact('orders', 'get_total', 'get_price'));
    }
}
