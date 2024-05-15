<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;
use App\Models\Brand;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:brand-list|brand-create|brand-edit|brand-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:brand-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:brand-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:brand-delete'], ['only' => ['destroy']]);
    }
    public function index()
    {
        return view('admin.brand.index');
    }
    public function create()
    {
        return view('admin.brand.create');
    }
    public function store(BrandFormRequest $request)
    {
        $validatedData = $request->validated();

        $brand = new Brand;
        $brand->name = $validatedData['name'];
        $brand->luggage = $validatedData['luggage'];
        $brand->passenger = $validatedData['passenger'];
        $brand->status = $request->status == true ? '1' : '0';

        $brand->save();
        return redirect('admin/brands')->with('message', 'Brands Has Added');
    }
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }
    public function update(BrandFormRequest $request, $brand)
    {
        $validatedData = $request->validated();
        $brand = Brand::findOrFail($brand);

        $brand->name = $validatedData['name'];
        $brand->luggage = $validatedData['luggage'];
        $brand->passenger = $validatedData['passenger'];
        $brand->status = $request->status == true ? '1' : '0';

        $brand->update();
        return redirect('admin/brands')->with('message', ' Brand update Succesfully');
    }
}
