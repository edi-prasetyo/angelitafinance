<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleFormRequest;
use App\Models\Balance;
use App\Models\Schedule;
use App\Models\ScheduleItem;
use App\Models\ScheduleLog;
use App\Models\Timer;
use App\Models\Transaction;
use App\Models\TransactionSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return view('admin.schedule.index', compact('schedules'));
    }
    public function create()
    {
        return view('admin.schedule.create');
    }
    public function store(Request $request)
    {

        $schedule = new Schedule;
        $schedule->schedule_date = $request['schedule_date'];

        $schedule->save();
        return redirect('admin/schedules')->with('message', 'Schedule Has Added');
    }
    public function add_item(int $schedule_id)
    {
        $transactions = Transaction::select('*')
            ->whereIn('order_status', [0, 1, 2, 3])
            ->get();
        $schedule = Schedule::findOrFail($schedule_id);
        $scheduleItems = ScheduleItem::where('schedule_id', $schedule_id)->get();
        return view('admin.schedule.add', compact('transactions', 'schedule', 'scheduleItems'));
    }
    public function add(Request $request)
    {

        $scheduleItem = new ScheduleItem;
        $scheduleItem->transaction_id = $request['transaction_id'];
        $scheduleItem->schedule_id = $request['schedule_id'];

        $scheduleItem->save();

        $transactionID = $scheduleItem->transaction_id;
        $transaction = Transaction::findOrFail($transactionID);


        ScheduleItem::where('id', $scheduleItem->id)->update([
            'driver_id' => $transaction->driver_id,
            'package_id' => $transaction->package_id,
            'package_name' => $transaction->package_name,
            'spj' => $transaction->spj,
            'car_id' => $transaction->car_id,
            'car_name' => $transaction->car_name,
            'car_number' => $transaction->car_number,
            'driver_name' => $transaction->driver_name,
            'driver_phone' => $transaction->driver_phone,
            'customer_name' => $transaction->customer_name,
            'customer_phone' => $transaction->customer_phone,
            'customer_address' => $transaction->customer_address,
            'pickup_address' => $transaction->pickup_address,
            'start_date' => $transaction->start_date,
            'end_date' => $transaction->end_date,
            'start_time' => $transaction->start_time,
            'end_time' => $transaction->end_time,
            'all_in' => $transaction->all_in,
            'order_status' => 1,
        ]);

        Transaction::where('id', $transaction->id)->update([
            'order_status' => 1,
        ]);

        return redirect('admin/schedules/add/' . $scheduleItem->schedule_id)->with('message', 'Schedule Has Added');
    }

    public function edit(int $schedule)
    {
        $scheduleItem = ScheduleItem::findOrFail($schedule);
        $timers = Timer::orderBy('id', 'asc')->get();
        return view('admin.schedule.edit', compact('scheduleItem', 'timers'));
    }
    public function update(Request $request, $schedule)
    {
        $scheduleItem = ScheduleItem::findOrFail($schedule);
        $scheduleItem->departure_time = $request['departure_time'];
        $scheduleItem->arrived_time = $request['arrived_time'];
        $scheduleItem->fuel_start = $request['fuel_start'];
        $scheduleItem->fuel_end = $request['fuel_end'];
        $scheduleItem->kilometers_start = $request['kilometers_start'];
        $scheduleItem->kilometers_end = $request['kilometers_end'];
        $scheduleItem->description = $request['description'];

        $scheduleItem->update();

        Transaction::where('id', $scheduleItem->transaction_id)->update([
            'departure_time' => $scheduleItem->departure_time,
            'arrived_time' => $scheduleItem->arrived_time,
            'fuel_start' => $scheduleItem->fuel_start,
            'fuel_end' => $scheduleItem->fuel_end,
            'kilometers_start' => $scheduleItem->kilometers_start,
            'kilometers_end' => $scheduleItem->kilometers_end,
            'description' => $scheduleItem->description
        ]);

        $userId = Auth::user()->id;
        $scheduleLog = new ScheduleLog;
        $scheduleLog->user_id = $userId;
        $scheduleLog->transaction_id = $scheduleItem->transaction_id;
        $scheduleLog->name = '';
        $scheduleLog->departure_time = $scheduleItem->departure_time;
        $scheduleLog->arrived_time = $scheduleItem->arrived_time;
        $scheduleLog->fuel_start = $scheduleItem->fuel_start;
        $scheduleLog->fuel_end = $scheduleItem->fuel_end;
        $scheduleLog->kilometers_start = $scheduleItem->kilometers_start;
        $scheduleLog->kilometers_end = $scheduleItem->kilometers_end;
        $scheduleLog->description = '';
        $scheduleLog->time = date('Y-m-d H:i:s');
        $scheduleLog->save();

        return redirect('admin/schedules/add/' . $scheduleItem->schedule_id)->with('message', 'Schedule Item update Succesfully');
    }

    public function show(int $schedule_item_id)
    {
        $scheduleItem = ScheduleItem::findOrFail($schedule_item_id);
        $scheduleLog = ScheduleLog::select(
            "schedule_log.id",
            "schedule_log.name",
            "schedule_log.time",
            "schedule_log.departure_time",
            "schedule_log.arrived_time",
            "schedule_log.fuel_start",
            "schedule_log.fuel_end",
            "schedule_log.kilometers_start",
            "schedule_log.kilometers_end",
            "schedule_log.description",
            "users.name as security_name"
        )
            ->join("users", "users.id", "=", "schedule_log.user_id")
            ->where('transaction_id', $scheduleItem->transaction_id)->orderBy('id', 'asc')
            ->get();
        // return $scheduleLog;
        return view('admin.schedule.show', compact('scheduleItem', 'scheduleLog'));
    }

    public function accept(int $transaction_id)
    {
        $userId = Auth::user()->id;

        $transaction = Transaction::findOrFail($transaction_id);
        $transaction->order_status = 2;
        $transaction->update();

        $scheduleLog = new ScheduleLog;
        $scheduleLog->user_id = $userId;
        $scheduleLog->transaction_id = $transaction->id;
        $scheduleLog->name = '';
        $scheduleLog->description = 'Order Diterima Driver';
        $scheduleLog->time = date('Y-m-d H:i:s');
        $scheduleLog->save();

        ScheduleItem::where('id', $transaction->id)->update([
            'order_status' => 2,
        ]);

        return redirect()->back()->with('message', 'Anda Telah menerima Order!');
    }
    public function on_road(int $transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);
        $transaction->order_status = 3;
        $transaction->update();

        $userId = Auth::user()->id;
        $scheduleLog = new ScheduleLog;
        $scheduleLog->user_id = $userId;
        $scheduleLog->transaction_id = $transaction->id;
        $scheduleLog->name = '';
        $scheduleLog->description = 'Order Dalam Perjalanan';
        $scheduleLog->time = date('Y-m-d H:i:s');
        $scheduleLog->save();

        ScheduleItem::where('id', $transaction->id)->update([
            'order_status' => 3,
        ]);

        return redirect()->back()->with('message', 'Anda Sudah dalam Perjalanan!');
    }

    public function additional(int $transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);
        // $transaction = Transaction::where('id', $scheduleItem->transaction_id)->first();
        // return $transaction;
        return view('admin.schedule.finish', compact('transaction'));
    }
    public function finish(Request $request, int $transaction_id)
    {
        // $validatedData = $request->validated();

        $transaction = Transaction::findOrFail($transaction_id);
        $transaction->order_status = 4;
        $transaction->status_transaction = 1;
        $transaction->over_time = $request['over_time'];
        $transaction->fuel_amount = $request['fuel_amount'];
        $transaction->parking_amount = $request['parking_amount'];
        $transaction->toll_amount = $request['toll_amount'];

        $transaction->update();

        $userId = Auth::user()->id;

        $balance = Balance::where('user_id', $userId)->first();
        $newAmount = $balance->amount + $transaction->spj;
        $balance->user_id = $userId;
        $balance->amount = $newAmount;
        $balance->update();

        $transaction_id = $transaction->transaction_id;

        $scheduleItem = ScheduleItem::firstOrFail('transaction_id');
        // $scheduleItem = ScheduleItem::where('transaction_id', $transaction_id)->first();
        $scheduleItem->order_status = 4;
        $scheduleItem->over_time = $scheduleItem->over_time;
        $scheduleItem->fuel_amount = $scheduleItem->fuel_amount;
        $scheduleItem->parking_amount = $scheduleItem->parking_amount;
        $scheduleItem->toll_amount = $scheduleItem->toll_amount;

        $scheduleItem->update();

        $scheduleLog = new ScheduleLog;
        $scheduleLog->user_id = $userId;
        $scheduleLog->transaction_id = $transaction->id;
        $scheduleLog->name = '';
        $scheduleLog->description = 'Driver Menyelesaikan Order';
        $scheduleLog->time = date('Y-m-d H:i:s');
        $scheduleLog->save();

        return redirect('admin/dashboard')->with('message', 'Anda Telah Menyelesaikan Order! Saldo Anda telah Bertambah');
    }
}
