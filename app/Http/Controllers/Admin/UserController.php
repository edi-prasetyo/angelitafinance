<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\Balance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:user-list|user-create|user-edit|user-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:user-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:user-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:user-delete'], ['only' => ['destroy']]);
    }
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.users.create', compact('roles'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|max:255', 'unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        // $user->role_as = $request['role_as'];
        $user->status = $request->status == true ? '1' : '0';
        $user->save();

        $user->assignRole($request->input('roles'));

        $balance = new Balance();
        $balance->user_id = $user->id;
        $balance->amount = 0;

        $balance->save();

        return redirect('admin/users')->with('message', 'Admin Has Added');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect('admin/users')->with('success', 'User updated successfully');
    }
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect('users')->with('success', 'User deleted successfully');
    }


    public function driver()
    {
        $users  = User::role('driver')->get();
        return view('admin.users.index', compact('users'));
    }
    public function admin()
    {
        $users  = User::role('admin')->get();
        return view('admin.users.index', compact('users'));
    }
    public function active($user_id)
    {
        $user =  User::where('id', $user_id)->first();
        $user->status = 1;
        $user->update();
        Alert::success('User', 'Berhasil Diaktifkan');
        return redirect()->back();
    }
    public function nonactive($user_id)
    {
        $user =  User::where('id', $user_id)->first();
        $user->status = 0;
        $user->update();
        Alert::success('User', 'Berhasil Dinonaktifkan');
        return redirect()->back();
    }
    public function finance()
    {
        $users = User::role('finance')->get();
        return view('admin.users.index', compact('users'));
    }
    public function security()
    {
        $users = User::where('role_as', 4)->get();
        return view('admin.users.index', compact('users'));
    }
}
