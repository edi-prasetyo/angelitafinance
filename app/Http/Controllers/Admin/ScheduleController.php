<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleFormRequest;
use App\Models\Balance;
use App\Models\OrderItem;
use App\Models\Schedule;
use App\Models\ScheduleItem;
use App\Models\ScheduleLog;
use App\Models\Timer;
use App\Models\Transaction;
use App\Models\TransactionSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class ScheduleController extends Controller
{
    public function index()
    {
        $tomorrow = Carbon::tomorrow();
        $start_date = date('Y-m-d', strtotime($tomorrow));
        $order_tomorrow = OrderItem::where('start_date', $start_date)
            ->join('customers', 'customers.id', '=', 'order_items.customer_id')
            ->select('order_items.*', 'customers.full_name as customer_name')
            ->get();



        return view('admin.schedule.index', compact('order_tomorrow'));
    }

    public function edit(int $order_item_id)
    {
        $drivers = User::role('driver')->get();
        $order_item = OrderItem::where('id', $order_item_id)->first();
        return view('admin.schedule.edit', compact('order_item', 'drivers'));
    }
    public function update(Request $request, $order_item_id)
    {
        $orderItem = OrderItem::where('id', $order_item_id)->first();

        $orderItem->driver_id = $request['driver_id'];
        $orderItem->stage = 1;
        $orderItem->update();
        Alert::success('Order', 'Berhasil Dikirim ke Driver');

        return redirect('admin/schedules');
    }
}
