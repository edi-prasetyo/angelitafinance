<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionFormRequest;
use App\Models\Car;
use App\Models\Customer;
use App\Models\Package;
use App\Models\ScheduleLog;
use App\Models\Timer;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:transaction-list|transaction-create|transaction-edit|transaction-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:transaction-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:transaction-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:transaction-delete'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $transactions = Transaction::orderBy('id', 'desc')->paginate(3);
        // dd($transactions);
        return view('admin.transactions.index', compact('transactions'));
    }
    public function create()
    {
        $cars = Car::all();
        $packages = Package::all();
        $customers = Customer::all();
        $timers = Timer::orderBy('id', 'asc')->get();

        return view('admin.transactions.create', compact('customers', 'cars', 'packages', 'timers'));
    }
    public function store(TransactionFormRequest $request)
    {
        $validatedData = $request->validated();

        $user_id = Auth::user()->id;
        $code = random_int(100000, 999999);
        $customer_id = $validatedData['customer_id'];
        $car_id = $validatedData['car_id'];
        $package_id = $validatedData['package_id'];


        $price = $validatedData['price'];
        $discount = $validatedData['discount'];
        $down_payment = $validatedData['down_payment'];
        $meal_cost = $validatedData['meal_cost'];
        $lodging_cost = $validatedData['lodging_cost'];
        $total_price = $price + $meal_cost + $lodging_cost - $discount - $down_payment;

        $transaction = new Transaction;
        $transaction->created_by = $user_id;
        $transaction->code = $code;
        $transaction->customer_id = $customer_id;
        $transaction->car_id = $car_id;
        $transaction->package_id = $package_id;
        $transaction->spj = $validatedData['spj'];
        $transaction->pickup_address = $validatedData['pickup_address'];
        $transaction->start_date = $validatedData['start_date'];
        $transaction->start_time = $validatedData['start_time'];
        $transaction->end_date = $validatedData['end_date'];
        $transaction->end_time = $validatedData['end_time'];
        $transaction->duration = $validatedData['duration'];
        $transaction->price = $price;
        $transaction->discount = $discount;
        $transaction->down_payment = $down_payment;
        $transaction->payment_method = $validatedData['payment_method'];
        $transaction->meal_cost = $meal_cost;
        $transaction->lodging_cost = $lodging_cost;
        $transaction->status = 0;
        $transaction->status_transaction = 0;
        $transaction->all_in = $validatedData['all_in'];
        $transaction->order_status = 0;
        $transaction->total_price = $total_price;
        $transaction->save();

        // Add Customer Data
        $customer = Customer::find($customer_id);
        $car = Car::find($car_id);
        $package = Package::find($package_id);
        Transaction::where('id', $transaction->id)->update([
            'customer_name' => $customer->full_name,
            'customer_phone' => $customer->phone,
            'customer_address' => $customer->address,
            'car_name' => $car->name,
            'car_number' => $car->number,
            'car_color' => $car->color,
            'car_seat' => $car->seat,
            'car_fuel' => $car->fuel,
            'package_name' => $package->name,
            'package_term' => $package->package_term,
        ]);
        // Create Finance
        return redirect('admin/transactions')->with('message', 'Order Has Added');
    }
    public function edit(int $transaction)
    {
        $cars = Car::all();
        $packages = Package::all();
        $customers = Customer::all();
        $timers = Timer::orderBy('id', 'asc')->get();
        $transaction = Transaction::findOrFail($transaction);
        return view('admin.transactions.edit', compact('transaction', 'customers', 'cars', 'packages', 'timers'));
    }
    public function update(TransactionFormRequest $request, int $transaction_id)
    {
        $validatedData = $request->validated();

        $user_id = Auth::user()->id;
        // $code = random_int(100000, 999999);
        $customer_id = $validatedData['customer_id'];
        $car_id = $validatedData['car_id'];
        $package_id = $validatedData['package_id'];

        $transaction = Transaction::where('id', $transaction_id)->first();
        $transaction->created_by = $user_id;
        // $transaction->code = $code;
        $transaction->customer_id = $customer_id;
        $transaction->car_id = $car_id;
        $transaction->package_id = $package_id;
        $transaction->spj = $validatedData['spj'];
        $transaction->pickup_address = $validatedData['pickup_address'];
        $transaction->start_date = $validatedData['start_date'];
        $transaction->start_time = $validatedData['start_time'];
        $transaction->end_date = $validatedData['end_date'];
        $transaction->end_time = $validatedData['end_time'];
        $transaction->duration = $validatedData['duration'];
        $transaction->price = $validatedData['price'];
        $transaction->discount = $validatedData['discount'];
        $transaction->down_payment = $validatedData['down_payment'];
        $transaction->payment_method = $validatedData['payment_method'];
        $transaction->meal_cost = $validatedData['meal_cost'];
        $transaction->lodging_cost = $validatedData['lodging_cost'];
        // $transaction->status = 0;
        // $transaction->status_transaction = 0;
        // $transaction->all_in = $validatedData['all_in'];
        // $transaction->order_status = 0;
        $transaction->update();

        // Add Customer Data
        $customer = Customer::find($customer_id);
        // return $customer;
        $car = Car::find($car_id);
        $package = Package::find($package_id);
        Transaction::where('id', $transaction->id)->update([
            'customer_name' => $customer->full_name,
            'customer_phone' => $customer->phone,
            'customer_address' => $customer->address,
            'car_name' => $car->name,
            'car_number' => $car->number,
            'car_color' => $car->color,
            'car_seat' => $car->seat,
            'car_fuel' => $car->fuel,
            'package_name' => $package->name,
            'package_term' => $package->package_term,
        ]);
        return redirect('admin/transactions')->with('message', 'Order Has Update');
    }
    public function detail(Request $request, int $transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);
        // $drivers = User::where('role_as', 5)->get();
        $drivers = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'Driver');
            }
        )->get();

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
            ->where('transaction_id', $transaction->id)->orderBy('id', 'asc')
            ->get();


        return view('admin.transactions.detail', compact('transaction', 'drivers', 'scheduleLog'));
    }

    public function add_schedule(Request $request, int $transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);
        $transaction->driver_id = $request['driver_id'];

        // Transaction::where('id', $transaction->id)->update([
        //     'driver_id' => $request['driver_id'],
        // ]);

        $user_id = $transaction->driver_id;
        $transaction_id = $transaction->id;
        $driver = User::findOrFail($user_id);
        Transaction::where('id', $transaction->id)->update([
            'driver_name' => $driver->name,
            'driver_phone' => $driver->phone,
            'driver_id' => $user_id,
        ]);

        return redirect('admin/transactions/detail/' . $transaction_id)->with('message', 'Order Has Added');
    }

    public function autocomplete(Request $request)
    {
        $data = [];

        if ($request->filled('q')) {
            $data = Customer::select("name", "id")
                ->where('name', 'LIKE', '%' . $request->get('q') . '%')
                ->get();
        }
        return response()->json($data);
    }

    // Sales
    public function sales(Request $request)
    {
        $date = $request->date;
        $transactions = Transaction::orderBy('id', 'desc')->where('start_date', $date)->get();
        // dd($transactions);
        return view('admin.transactions.sales', compact('transactions'));
    }
}
