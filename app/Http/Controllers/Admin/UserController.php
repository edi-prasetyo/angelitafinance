<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\Balance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        return view('admin.users.create');
    }
    public function store(UserFormRequest $request)
    {
        $validatedData = $request->validated();

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role_as = $validatedData['role_as'];
        $user->status = $request->status == true ? '1' : '0';
        $user->save();

        $balance = new Balance();
        $balance->user_id = $user->id;
        $balance->amount = 0;

        $balance->save();

        return redirect('admin/users')->with('message', 'Admin Has Added');
    }
    public function driver()
    {
        $users = User::where('role_as', 5)->get();
        return view('admin.users.index', compact('users'));
    }
    public function finance()
    {
        $users = User::where('role_as', 3)->get();
        return view('admin.users.index', compact('users'));
    }
    public function security()
    {
        $users = User::where('role_as', 4)->get();
        return view('admin.users.index', compact('users'));
    }
}
