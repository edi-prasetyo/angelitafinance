<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Car;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Package;
use App\Models\Partner;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\Timer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Concerns\FromCollection;


use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class OrderController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:order-list|order-create|order-edit|order-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:order-create'], ['only' => ['create', 'store', 'add_order_item', 'store_order_item', 'add_payment']]);
        $this->middleware(['permission:order-edit'], ['only' => ['edit', 'update', 'edit_item', 'update_item', 'destroy_item', 'trash', 'cancel']]);
        $this->middleware(['permission:order-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        $customers2 = Customer::all();
        $rentals = Rental::all();
        $partners = Partner::all();
        // $payments = Payment::all();
        $amountSum = OrderItem::selectRaw('sum(price)')
            ->whereColumn('order_id', 'orders.id')
            ->getQuery();

        $orders = Order::select('orders.*', 'customers.full_name as customer_name', 'rentals.name as rental_name')
            ->where(['orders.status' => 1, 'orders.cancel' => 1])
            ->where('bill', '>', 0)
            ->selectSub($amountSum, 'amount_sum')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->join('rentals', 'rentals.id', '=', 'orders.rental_id')
            ->orderBy('id', 'desc')
            ->with('orderCount')
            ->paginate(10);
        // return $orders->orderCount;
        $title = 'Delete Order!';
        $text = "Anda Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
        return view('admin.orders.index', compact('orders', 'customers', 'customers2', 'rentals', 'partners'));
    }

    public function unpaid(Request $request)
    {
        $customer_id = $request['customer_id'];
        if ($customer_id) {
            $customers = Customer::all();
            // $customers2 = Customer::all();
            $rentals = Rental::all();
            $partners = Partner::all();
            // $payments = Payment::all();
            $amountSum = OrderItem::selectRaw('sum(price)')
                ->whereColumn('order_id', 'orders.id')
                ->getQuery();

            $orders = Order::select('orders.*', 'customers.full_name as customer_name', 'rentals.name as rental_name')
                ->where(['orders.status' => 1, 'orders.cancel' => 1])
                ->where('bill', '>', 0)
                ->where('customer_id', $customer_id)
                ->selectSub($amountSum, 'amount_sum')
                ->join('customers', 'customers.id', '=', 'orders.customer_id')
                ->join('rentals', 'rentals.id', '=', 'orders.rental_id')
                ->orderBy('id', 'desc')
                ->with('orderCount')
                ->paginate(10);
            // return $orders->orderCount;
            $title = 'Delete Order!';
            $text = "Anda Yakin ingin menghapus data ini?";
            confirmDelete($title, $text);
            return view('admin.orders.unpaid', compact('orders', 'customers', 'rentals', 'partners', 'customer_id'));
        } else {
            $customers = Customer::all();
            $customer_id = '';
            // $customers2 = Customer::all();
            $rentals = Rental::all();
            $partners = Partner::all();
            // $payments = Payment::all();
            $amountSum = OrderItem::selectRaw('sum(price)')
                ->whereColumn('order_id', 'orders.id')
                ->getQuery();

            $orders = Order::select('orders.*', 'customers.full_name as customer_name', 'rentals.name as rental_name')
                ->where(['orders.status' => 1, 'orders.cancel' => 1])
                ->where('bill', '>', 0)
                ->selectSub($amountSum, 'amount_sum')
                ->join('customers', 'customers.id', '=', 'orders.customer_id')
                ->join('rentals', 'rentals.id', '=', 'orders.rental_id')
                ->orderBy('id', 'desc')
                ->with('orderCount')
                ->paginate(10);
            // return $orders->orderCount;
            $title = 'Delete Order!';
            $text = "Anda Yakin ingin menghapus data ini?";
            confirmDelete($title, $text);
            return view('admin.orders.unpaid', compact('orders', 'customers', 'rentals', 'partners', 'customer_id'));
        }
    }

    public function paid()
    {
        $customers = Customer::all();
        $rentals = Rental::all();
        $partners = Partner::all();
        // $payments = Payment::all();
        $amountSum = OrderItem::selectRaw('sum(price)')
            ->whereColumn('order_id', 'orders.id')
            ->getQuery();

        $orders = Order::select('orders.*', 'customers.full_name as customer_name', 'rentals.name as rental_name')
            ->where(['orders.status' => 1, 'orders.cancel' => 1])
            ->where('bill', '=', 0)
            ->selectSub($amountSum, 'amount_sum')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->join('rentals', 'rentals.id', '=', 'orders.rental_id')
            ->orderBy('id', 'desc')
            ->with('orderCount')
            ->paginate(10);
        // return $orders->orderCount;
        $title = 'Delete Order!';
        $text = "Anda Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);

        return view('admin.orders.paid', compact('orders', 'customers', 'rentals', 'partners'));
    }
    public function order_cancel()
    {
        $customers = Customer::all();
        $rentals = Rental::all();
        $partners = Partner::all();
        // $payments = Payment::all();
        $amountSum = OrderItem::selectRaw('sum(price)')
            ->whereColumn('order_id', 'orders.id')
            ->getQuery();

        $orders = Order::select('orders.*', 'customers.full_name as customer_name', 'rentals.name as rental_name')
            ->where(['orders.status' => 1, 'orders.cancel' => 0])
            ->where('bill', '=', 0)
            ->selectSub($amountSum, 'amount_sum')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->join('rentals', 'rentals.id', '=', 'orders.rental_id')
            ->orderBy('id', 'desc')
            ->with('orderCount')
            ->paginate(10);
        // return $orders->orderCount;
        $title = 'Delete Order!';
        $text = "Anda Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);

        return view('admin.orders.cancel', compact('orders', 'customers', 'rentals', 'partners'));
    }

    public function create()
    {
        $customers = Customer::all();
        $rentals = Rental::all();
        return view('admin.orders.create', compact('customres', 'rentals'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required',
            'date' => 'required',
            'start_date' => 'required',
        ]);
        $user_id = Auth::user()->id;
        $code = random_int(100000, 999999);

        $order = new Order();
        $order->user_id = $user_id;
        $order->customer_id = $validated['customer_id'];
        $order->rental_id = $request['rental_id'];
        $order->partner_id = $request['partner_id'];
        $order->order_date = $validated['date'];
        $order->start_date = $validated['start_date'];
        $order->order_code = $code;
        $order->status = 1;
        $order->cancel = 1;

        $order->save();
        $id = $order->id;

        Alert::success('Order', 'Berhasil Dibuat');
        return redirect()->route('show', $id);
    }
    public function show(int $id)
    {
        $order = Order::where('orders.id', $id)
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('orders.*', 'customers.full_name as customer_name')
            ->first();
        $order_items  = OrderItem::where('order_id', $id)
            ->join('cars', 'cars.id', '=', 'order_items.car_id')
            ->join('packages', 'packages.id', '=', 'order_items.package_id')
            ->select('order_items.*', 'cars.name as car_name', 'packages.name as package_name')
            ->get();

        $pickups  = OrderItem::where('order_id', $id)
            ->join('users', 'users.id', '=', 'order_items.driver_id')
            ->select('order_items.*', 'users.name as driver_name')
            ->get();
        $payments = Payment::where('order_id', $id)->get();
        $rental = Rental::where('id', $order->rental_id)->first();
        $banks = Bank::where('status', 1)->get();
        $grand_total = OrderItem::where('order_id', $id)
            ->sum('price');
        // return $rental;
        return view('admin.orders.show', compact('order', 'order_items', 'payments', 'rental', 'banks', 'pickups', 'grand_total'));
    }


    // Load Pdf
    public function download($order_id)
    {
        $order = Order::where('orders.id', $order_id)
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('orders.*', 'customers.full_name as customer_name')
            ->first();
        $order_items = OrderItem::where('order_id', $order_id)
            ->join('cars', 'cars.id', '=', 'order_items.car_id')
            ->join('packages', 'packages.id', '=', 'order_items.package_id')
            ->select('order_items.*', 'cars.name as car_name', 'packages.name as package_name')
            ->get();
        $pickups = OrderItem::where('order_id', $order_id)
            ->get();
        $grand_total = OrderItem::where('order_id', $order_id)
            ->sum('price');
        // return $grand_total;
        $rental = Rental::where('id', $order->rental_id)->first();
        // $logo = base64_encode(file_get_contents(public_path($rental->logo)));
        $payments = Payment::where('order_id', $order_id)->get();
        $banks = Bank::where('status', 1)->get();


        $data = [
            'title' => 'Rental',
            'date' => date('m/d/Y'),
            'order' => $order,
            'order_items' => $order_items,
            'rental' => $rental,
            // 'logo' => $logo,
            'payments' => $payments,
            'grand_total' => $grand_total,
            'banks' => $banks,
            'pickups' => $pickups

        ];

        // return $data;
        // $customPaper = [0, 0, 567.00, 500.80];

        $pdf = Pdf::loadView('admin.orders.download', $data)->setPaper('letter', 'portrait');
        return $pdf->download(str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf');

        // return view('admin.orders.download', $data);
        // return view('admin.orders.downloadtest', $data);
    }
    // Print 
    public function print($order_id)
    {
        $order = Order::where('orders.id', $order_id)
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('orders.*', 'customers.full_name as customer_name')
            ->first();
        $order_items = OrderItem::where('order_id', $order_id)
            ->join('cars', 'cars.id', '=', 'order_items.car_id')
            ->join('packages', 'packages.id', '=', 'order_items.package_id')
            ->select('order_items.*', 'cars.name as car_name', 'packages.name as package_name')
            ->get();
        $pickups = OrderItem::where('order_id', $order_id)
            ->join('users', 'users.id', '=', 'order_items.driver_id')
            ->select('order_items.*', 'users.name as driver_name')
            ->get();
        $grand_total = OrderItem::where('order_id', $order_id)
            ->sum('price');
        // return $grand_total;
        $rental = Rental::where('id', $order->rental_id)->first();
        // $logo = base64_encode(file_get_contents(public_path($rental->logo)));
        $payments = Payment::where('order_id', $order_id)->get();
        $banks = Bank::where('status', 1)->get();


        $data = [
            'title' => 'Rental',
            'date' => date('m/d/Y'),
            'order' => $order,
            'order_items' => $order_items,
            'rental' => $rental,
            // 'logo' => $logo,
            'payments' => $payments,
            'grand_total' => $grand_total,
            'banks' => $banks,
            'pickups' => $pickups

        ];


        return view('admin.orders.print', $data);
    }

    public function cancel($id)
    {
        $order = Order::where('id', $id)->first();
        $order->cancel = 0;
        $order->update();

        $order_items = OrderItem::where('order_id', $order->id)->get();
        foreach ($order_items as $item) {

            $item->cancel = 0;
            $item->update();
        }

        Alert::success('Order', 'Berhasil Dicancel');
        return redirect()->back();
    }
    public function trash($id)
    {
        $order = Order::where('id', $id)->first();
        $order->status = 0;
        $order->update();

        $order_items_status = OrderItem::where('order_id', $order->id)->get();
        foreach ($order_items_status as $item_status) {

            $item_status->status = 0;
            $item_status->update();
        }

        Alert::success('Order', 'Berhasil Di Pindahkan ke sampah');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $order = Order::where('id', $id)->first();
        $payment = Payment::where('order_id', $order->id)->get();
        $order->delete();

        foreach ($payment as $payment) {
            $path = 'uploads/images/' . $payment->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        Alert::success('Order Item', 'Berhasil Dibuat');
        return redirect()->back();
    }
    public function add_order_item($id)
    {
        $cars = Car::all();
        $packages = Package::all();
        $timers = Timer::orderBy('id', 'asc')->get();
        $drivers = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'Driver');
            }
        )->get();
        $order = Order::where('orders.id', $id)
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('orders.*', 'customers.full_name as customer_name')
            ->first();
        return view('admin.orders.create_item', compact('order', 'cars', 'packages', 'timers', 'drivers'));
    }

    public function store_order_item(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required',
            'order_id' => 'required',
            'car_id' => 'required',
            'package_id' => 'required',
            'driver_id' => 'required',
            'pickup_address' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
            'item_price' => 'required',
            // 'price' => 'required',
            // 'overtime' => 'nullable',

        ]);

        $overtime = $request['overtime'];
        $item_price = $validated['item_price'];
        $price =  $overtime + $item_price;

        $order_item = new OrderItem();

        $order_item->order_id = $validated['order_id'];
        $order_item->customer_id = $validated['customer_id'];
        $order_item->car_id = $validated['car_id'];
        $order_item->package_id = $validated['package_id'];
        $order_item->driver_id = $validated['driver_id'];
        $order_item->spj = $request['spj'];
        $order_item->pickup_address = $validated['pickup_address'];
        $order_item->start_date = $validated['start_date'];
        $order_item->start_time = $validated['start_time'];
        $order_item->end_date = $validated['end_date'];
        $order_item->end_time = $validated['end_time'];
        $order_item->item_price = $item_price;
        $order_item->price = $price;
        $order_item->overtime = $overtime;
        $order_item->meal_cost = $request['meal_cost'];
        $order_item->lodging_cost = $request['lodging_cost'];
        $order_item->all_in = $request->all_in == true ? '1' : '0';

        $order_item->fuel = $request->fuel == true ? '1' : '0';
        $order_item->toll = $request->toll == true ? '1' : '0';
        $order_item->parking = $request->parking == true ? '1' : '0';
        $order_item->meal = $request->meal == true ? '1' : '0';
        $order_item->lodging = $request->lodging == true ? '1' : '0';
        $order_item->pickup_charge = $request->pickup_charge == true ? '1' : '0';
        $order_item->status = 1;
        $order_item->cancel = 1;

        $order_item->save();

        $order = Order::where('id', $order_item->order_id)->first();
        $total_amount = $order->bill + $order_item->price;
        $order->bill = $total_amount;
        $order->update();
        Alert::success('Order Item', 'Berhasil Dibuat');
        return redirect('admin/orders/detail/' . $order->id);
    }

    public function edit_item($item_id)
    {
        $cars = Car::all();
        $packages = Package::all();
        $timers = Timer::orderBy('id', 'asc')->get();
        $drivers = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'Driver');
            }
        )->get();
        $order_item = OrderItem::where('id', $item_id)->first();
        $order = Order::where('orders.id', $order_item->order_id)
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('orders.*', 'customers.full_name as customer_name')
            ->first();
        // return $order;
        return view('admin.orders.edit_item', compact('order_item', 'order', 'cars', 'packages', 'timers', 'drivers'));
    }

    public function update_item(Request $request, $order_item_id)
    {
        $validated = $request->validate([
            'customer_id' => 'required',
            'order_id' => 'required',
            'car_id' => 'required',
            'package_id' => 'required',
            'driver_id' => 'required',
            'pickup_address' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
            // 'price' => 'required',
            // 'overtime' => 'nullable',

        ]);

        $new_price = $request['item_price'];
        $overtime = $request['overtime'];

        $order_item = OrderItem::where('id', $order_item_id)->first();

        $order = Order::where('id', $order_item->order_id)->first();
        $price = $new_price + $overtime;

        $last_order_bill = $order->bill - $order_item->price;

        $order_item->order_id = $validated['order_id'];
        $order_item->customer_id = $validated['customer_id'];
        $order_item->car_id = $validated['car_id'];
        $order_item->package_id = $validated['package_id'];
        $order_item->driver_id = $validated['driver_id'];
        $order_item->spj = $request['spj'];
        $order_item->pickup_address = $validated['pickup_address'];
        $order_item->start_date = $validated['start_date'];
        $order_item->start_time = $validated['start_time'];
        $order_item->end_date = $validated['end_date'];
        $order_item->end_time = $validated['end_time'];
        $order_item->departure_time = $request['departure_time'];
        $order_item->arrival_time = $request['arrival_time'];
        $order_item->item_price = $new_price;
        $order_item->price = $price;
        $order_item->overtime = $overtime;
        $order_item->meal_cost = $request['meal_cost'];
        $order_item->lodging_cost = $request['lodging_cost'];
        $order_item->all_in = $request->all_in == true ? '1' : '0';

        $order_item->fuel = $request->fuel == true ? '1' : '0';
        $order_item->toll = $request->toll == true ? '1' : '0';
        $order_item->parking = $request->parking == true ? '1' : '0';
        $order_item->meal = $request->meal == true ? '1' : '0';
        $order_item->lodging = $request->lodging == true ? '1' : '0';
        $order_item->pickup_charge = $request->pickup_charge == true ? '1' : '0';

        $order_item->update();


        $total_amount = $last_order_bill + $new_price + $order_item->overtime;
        // return $last_order_bill;
        $order->bill = $total_amount;
        $order->update();

        Alert::success('Order Item', 'Berhasil Update');
        return redirect('admin/orders/detail/' . $order->id);
    }
    public function destroy_item($order_item_id)
    {
        $order_item = OrderItem::where('id', $order_item_id)->first();
        // return $order_item_id;
        $order_item->delete();


        $order = Order::where('id', $order_item->order_id)->first();
        $total_amount = $order->bill - $order_item->price;
        $order->bill = $total_amount;
        $order->update();


        Alert::success('Order Item', 'Berhasil Dihapus');
        return redirect()->back();
    }

    // Payment Function
    public function payment($order_id)
    {
        $payments = Payment::where('order_id', $order_id)->get();
        $order = Order::where('id', $order_id)->first();
        return view('admin.orders.payment', compact('order', 'payments'));
    }
    public function add_payment(Request $request)
    {
        $user_id = Auth::user()->id;

        $validated = $request->validate([
            'payment_date' => 'required',
            'amount' => 'required',
            'payment_type' => 'required',
        ]);
        $payment = new Payment();
        $payment->user_id = $user_id;
        $payment->order_id = $request['order_id'];
        $payment->payment_date = $validated['payment_date'];
        $payment->payment_type = $validated['payment_type'];
        $payment->payment_method = $request['payment_method'];
        $payment->amount = $validated['amount'];

        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
            $img = $manager->read($request->file('image'));

            $img = $img->scale(400);
            // $img->toJpeg()->save(base_path('public/uploads/images/' . $name_gen));
            $img->toJpeg()->save('uploads/images/' . $name_gen);
            $save_url = $name_gen;

            $payment->image = $save_url;
            $payment->image_url = URL::to('/uploads/images/' . $name_gen);
        }

        $payment->save();

        $order = Order::where('id', $payment->order_id)->first();
        $total_amount = $order->bill - $payment->amount;
        $order->bill = $total_amount;
        $order->update();

        Alert::success('Payment', 'Payment Berhasil Di tambahkan');
        return redirect()->back();
    }

    public function sales(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $amountSum = OrderItem::selectRaw('sum(price)')
            ->whereColumn('order_id', 'orders.id')
            ->getQuery();

        $orders = Order::orderBy('order_date', 'DESC')
            ->with('payments')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('orders.*', 'customers.full_name as customer_name')
            ->selectSub($amountSum, 'amount_sum')
            ->whereBetween('order_date', [$start_date,  $end_date])
            ->get();
        // return $orders;
        $get_total = $orders->sum('bill');
        $get_price = $orders->sum('amount_sum');
        return view('admin.orders.sales', compact('orders', 'get_total', 'get_price', 'start_date', 'end_date'));
    }
    public function sales_item(Request $request)
    {

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $order_items = OrderItem::orderBy('start_date', 'DESC')
            ->join('customers', 'customers.id', '=', 'order_items.customer_id')
            ->join('packages', 'packages.id', '=', 'order_items.package_id')
            ->join('cars', 'cars.id', '=', 'order_items.car_id')
            ->join('users', 'users.id', '=', 'order_items.driver_id')
            ->select('order_items.*', 'customers.full_name as customer_name', 'packages.name as package_name', 'cars.name as car_name', 'cars.number as car_number', 'users.name as driver_name')
            ->whereBetween('start_date', [$start_date,  $end_date])
            ->get();
        $get_total = $order_items->sum('price');
        // return $total;
        // $get_total =   DB::table('order_items')
        //     ->whereBetween('start_date', [$start_date,  $end_date])
        //     ->selectRaw('sum(price) as total')
        //     ->selectRaw('id')
        //     ->groupBy('id')
        //     ->get();
        // return   $get_total->total;

        return view('admin.orders.sales_items', compact('order_items', 'get_total'));
    }
}
