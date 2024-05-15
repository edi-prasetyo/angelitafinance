<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerFormRequest;
use App\Models\Customer;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:customer-list|customer-create|customer-edit|customer-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:customer-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:customer-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:customer-delete'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->paginate(15);
        $title = 'Delete Customer!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.customers.index', compact('customers'));
    }
    public function create()
    {
        return view('admin.customers.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'full_name' => 'required',
                'phone_number' => 'required|unique:customers',
                'customer_name' => 'nullable',
            ],
            [
                'full_name.required' => 'Bidang Ini Harus Di Isi!',
                'phone_number.required' => 'Nomor Whatsapp Harus Di isi!',
                'phone_number.unique' => 'Nomor Whatsapp Sudah Ada!'
            ]
        );

        // $validatedData = $request->validated();

        $customer = new Customer();
        $customer->full_name = $validated['full_name'];
        $customer->phone_number = $validated['phone_number'];
        $customer->customer_name =  $validated['full_name'];
        $customer->save();
        Alert::success('Customer', 'Customer Berhasil Dibuat');
        return back();
    }
    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }
    public function update(CustomerFormRequest $request, $customer)
    {
        $validatedData = $request->validated();
        $customer = Customer::findOrFail($customer);

        $customer->name = $validatedData['name'];
        $customer->whatsapp = $validatedData['whatsapp'];

        $customer->update();
        Alert::success('Customer', 'Berhasil di Update');
        return redirect('admin/customers')->with('message', 'Customer update Succesfully');
    }
    public function destroy(int $customer_id)
    {
        $customer = Customer::findOrFail($customer_id);
        $customer->delete();
        Alert::success('Customer', 'Berhasil di Hapus');
        return back();
    }

    // Admin Function
    public function calling()
    {

        $customers = Customer::where('read', 2)->paginate(10);
        return view('admin.customers.calling', compact('customers'));
    }
    public function gift()
    {
        $customers = Customer::where('gift', 0)->paginate(10);
        return view('admin/customers/gift', compact('customers'));
    }

    public function update_read(int $customer_id)
    {

        $customer = Customer::where('id', $customer_id)->first();
        $customer->read = 1;
        $customer->update();

        if (substr(trim($customer->whatsapp), 0, 1) == "0") {
            $hp    = "62" . substr(trim($customer->whatsapp), 1);
        }
        // return redirect('https://wa.me/' . $hp);
        // return redirect()->back()->with('message', 'Gift Card Sudah dikirim');
        Alert::success('Gift', 'Gift Card sudah dikirim');
        return back();
    }

    public function update_gift(int $customer_id)
    {

        $customer = Customer::where('id', $customer_id)->first();
        $customer->read = 2;
        $customer->gift = 1;
        $customer->update();
        Alert::success('Gift', 'Gift Card sudah dikirim');
        return back();
    }
}
