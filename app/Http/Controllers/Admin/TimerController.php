<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Timer;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TimerController extends Controller
{
    public function index()
    {
        $timers = Timer::orderBy('id', 'desc')->paginate(10);
        $title = 'Delete Timer!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.timer.index', compact('timers'));
    }
    public function create()
    {
        return view('admin.timers.create');
    }
    public function store(Request $request)
    {

        $customer = new Timer();
        $customer->name = $request['name'];

        $customer->save();
        Alert::success('Timer', 'Customer Berhasil Dibuat');
        return back();

        // return redirect('admin/timers')->with('message', 'Timer Has Added');
    }
    public function edit(int $timer_id)
    {
        $timer = Timer::where('id', $timer_id)->first();

        return view('admin.timer.edit', compact('timer'));
    }
    public function update(Request $request, $timer)
    {
        $timer = Timer::findOrFail($timer);
        $timer->name = $request['name'];
        $timer->update();
        Alert::success('Timer', 'Berhasil di Update');
        return redirect('admin/timers')->with('message', 'Customer update Succesfully');
    }
    public function destroy(int $timer_id)
    {
        $timer = Timer::findOrFail($timer_id);
        $timer->delete();
        Alert::success('Timer', 'Berhasil di Hapus');
        return back();
    }
}
