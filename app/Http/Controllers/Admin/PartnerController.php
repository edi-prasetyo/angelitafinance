<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::all();
        return view('admin.partners.index', compact('partners'));
    }
    public function store(Request $request)
    {
        $partner = new Partner();
        $partner->name = $request['name'];
        $partner->save();
        Alert::success('Partner', 'Berhasil Dibuat');
        return redirect()->back();
    }
}
