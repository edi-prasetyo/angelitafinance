<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use RealRashid\SweetAlert\Facades\Alert;

class BankController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:bank-list|bank-create|bank-edit|bank-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:bank-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:bank-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:bank-delete'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $banks = Bank::all();
        return view('admin.banks.index', compact('banks'));
    }
    public function create()
    {
        return view('admin.banks.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bank_name' => 'required',
        ]);

        $bank = new Bank();
        $bank->bank_name = $validated['bank_name'];
        $bank->bank_number = $request['bank_number'];
        $bank->bank_account = $request['bank_account'];


        $uploadPath = 'uploads/images/';
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename = 'bank' . time() . '.' . $ext;
            $file->move('uploads/images/', $filename);
            $bank->logo = $uploadPath . $filename;
            $bank->logo_url = URL::to('/uploads/images/' . $filename);
        }

        $bank->status = $request->status == true ? '1' : '0';

        $bank->save();
        Alert::success('Bank', 'Berhasil Dibuat');
        return redirect('admin/banks');
    }
    public function edit(Bank $bank)
    {
        // return $rental;
        return view('admin.banks.edit', compact('bank'));
    }
    public function update(Request $request, $bank_id)
    {
        $validated = $request->validate([

            'bank_name' => 'required',
        ]);
        $bank = Bank::findOrFail($bank_id);

        $bank->bank_name = $validated['bank_name'];
        $bank->bank_number = $request['bank_number'];
        $bank->bank_account = $request['bank_account'];

        $uploadPath = 'uploads/images/';
        if ($request->hasFile('logo')) {

            $path = 'uploads/images/' . $bank->logo;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename = 'bank' . time() . '.' . $ext;
            $file->move('uploads/images/', $filename);
            $bank->logo = $uploadPath . $filename;
            $bank->logo_url = URL::to('/uploads/images/' . $filename);
        }


        $bank->status = $request->status == true ? '1' : '0';

        $bank->update();
        Alert::success('Bank', 'Berhasil Diupdate');
        return redirect('admin/banks');
    }
}
