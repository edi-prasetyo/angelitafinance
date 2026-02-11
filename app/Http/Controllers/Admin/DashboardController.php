<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Schedule;
use App\Models\ScheduleItem;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $orderDriver = Transaction::where('driver_id', $userId)->get();
        $shcedules = Schedule::orderBy('id', 'desc')->paginate(3);
        $balance = Balance::where('user_id', $userId)->first();
        $transactions = Order::all();
        $customers = Customer::all();
        $total_orders = OrderItem::all();

        $count_today = Customer::where('read', 1)->whereDate('updated_at', Carbon::today())->get();
        $customer_calls = Customer::where('read', 0)->get();
        $count_all = Customer::where('read', 1)->get();

        $drivers = User::role('driver')->get();
        // return $driver;

        // $data = [10, 19, 25, 0, 40, 43, 50, 40, 23, 41, 3];
        // $month = ['January', 'February', 'March', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $chartTransaction = OrderItem::select(
            DB::raw("COUNT(*) as count"),
            DB::raw("MONTHNAME(start_date) as month_name"),
            DB::raw("MONTH(start_date) as month_number")
        )
            ->whereYear('start_date', date('Y'))
            ->where(['cancel' => 1, 'status' => 1])
            ->groupBy('month_number', 'month_name')
            ->orderBy('month_number')
            ->pluck('count', 'month_name');
        $month = $chartTransaction->keys();
        $data = $chartTransaction->values();

        // return $month;


        return view('admin.dashboard', compact('drivers', 'shcedules', 'orderDriver', 'balance', 'transactions', 'customers', 'data', 'month', 'count_today', 'customer_calls', 'count_all', 'total_orders'));
    }
}
