<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageFormRequest;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }
    public function create()
    {
        return view('admin.packages.create');
    }
    public function store(PackageFormRequest $request)
    {
        $validatedData = $request->validated();

        $package = new Package();
        $package->name = $validatedData['name'];
        $package->package_term = $validatedData['package_term'];
        $package->status = $request->status == true ? '1' : '0';

        $package->save();
        return redirect('admin/packages')->with('message', 'Package Has Added');
    }
    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }
    public function update(PackageFormRequest $request, $package)
    {
        $validatedData = $request->validated();
        $package = Package::findOrFail($package);

        $package->name = $validatedData['name'];
        $package->package_term = $validatedData['package_term'];
        $package->status = $request->status == true ? '1' : '0';

        $package->update();
        return redirect('admin/packages')->with('message', 'Package update Succesfully');
    }
    public function destroy(int $package_id)
    {
        $package = Package::findOrFail($package_id);
        $package->delete();
        return redirect()->back()->with('message', 'Package has ben Deleted!');
    }
}
