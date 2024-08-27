<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use RealRashid\SweetAlert\Facades\Alert;

class RentalController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:rental-list|rental-create|rental-edit|rental-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:rental-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:rental-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:rental-delete'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $rentals = Rental::all();
        return view('admin.rentals.index', compact('rentals'));
    }
    public function create()
    {
        return view('admin.rentals.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => 'required|unique:rentals',
            'name' => 'required',
        ]);

        $rental = new Rental();
        $rental->name = $validated['name'];
        $rental->legal_name = $request['legal_name'];
        $rental->phone_number = $validated['phone_number'];
        $rental->address = $request['address'];
        $rental->email = $request['email'];
        $rental->website = $request['website'];
        $rental->pic_name = $request['pic_name'];
        $rental->bank = $request['bank'];
        $rental->account = $request['account'];
        $rental->number = $request['number'];

        $uploadPath = 'uploads/images/';
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename = 'rental' . time() . '.' . $ext;
            $file->move('uploads/images/', $filename);
            $rental->logo = $uploadPath . $filename;
            $rental->logo_url = URL::to('/uploads/images/' . $filename);
        }
        $uploadPath = 'uploads/images/';
        if ($request->hasFile('signature')) {
            $file = $request->file('signature');
            $ext = $file->getClientOriginalExtension();
            $filename = 'signature' . time() . '.' . $ext;
            $file->move('uploads/images/', $filename);
            $rental->signature = $uploadPath . $filename;
            $rental->signature_url = URL::to('/uploads/images/' . $filename);
        }

        $rental->status = $request->status == true ? '1' : '0';

        $rental->save();
        Alert::success('Rental', 'Berhasil Dibuat');
        return redirect('admin/rentals')->with('message', 'Rental Has Added');
    }
    public function edit(Rental $rental)
    {
        // return $rental;
        return view('admin.rentals.edit', compact('rental'));
    }
    public function update(Request $request, $rental_id)
    {
        $validated = $request->validate([

            'name' => 'required',
        ]);
        $rental = Rental::findOrFail($rental_id);

        $rental->name = $validated['name'];
        $rental->legal_name = $request['legal_name'];
        $rental->phone_number = $request['phone_number'];
        $rental->address = $request['address'];
        $rental->email = $request['email'];
        $rental->website = $request['website'];
        $rental->pic_name = $request['pic_name'];
        $rental->bank = $request['bank'];
        $rental->account = $request['account'];
        $rental->number = $request['number'];

        $uploadPath = 'uploads/images/';
        if ($request->hasFile('logo')) {

            $path = 'uploads/images/' . $rental->logo;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename = 'rental' . time() . '.' . $ext;
            $file->move('uploads/images/', $filename);
            $rental->logo = $uploadPath . $filename;
            $rental->logo_url = URL::to('/uploads/images/' . $filename);
        }
        $uploadPath = 'uploads/images/';
        if ($request->hasFile('signature')) {

            $path = 'uploads/images/' . $rental->signature;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('signature');
            $ext = $file->getClientOriginalExtension();
            $filename = 'signature' . time() . '.' . $ext;
            $file->move('uploads/images/', $filename);
            $rental->signature = $uploadPath . $filename;
            $rental->signature_url = URL::to('/uploads/images/' . $filename);
        }

        $rental->status = $request->status == true ? '1' : '0';

        $rental->update();
        Alert::success('Rental', 'Berhasil Diupdate');
        return redirect('admin/rentals')->with('message', 'Category update Succesfully');
    }
}
