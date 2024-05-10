<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Customer;
use App\Models\Schedule;
use App\Models\ScheduleItem;
use App\Models\Transaction;
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
        $transactions = Transaction::where('status_transaction', 1)->get();
        $customers = Customer::all();

        $count_today = Customer::where('read', 1)->whereDate('updated_at', Carbon::today())->get();
        $customer_calls = Customer::where('read', 0)->get();
        $count_all = Customer::where('read', 1)->get();

        // $data = [10, 19, 25, 0, 40, 43, 50, 40, 23, 41, 3];
        $month = ['Jan', 'Feb', 'March', 'May', 'Jun', 'Jul', 'August', 'Sept', 'Oct', 'Nov', 'Des'];
        $chartTransaction = Transaction::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("month_name"))
            ->orderBy('id', 'ASC')
            ->pluck('count', 'month_name');
        // $month = $transactions->keys();
        $data = $chartTransaction->values();




        return view('admin.dashboard', compact('shcedules', 'orderDriver', 'balance', 'transactions', 'customers', 'data', 'month', 'count_today', 'customer_calls', 'count_all'));
    }
}
