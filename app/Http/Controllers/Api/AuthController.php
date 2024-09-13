<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Requests\Api\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all);

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('', 'Credential do not match', 401);
        }

        // $users = User::role('writer')->get(); 
        $user = User::where('email', $request->email)->role('superadmin')->first();
        if ($user) {
            return $this->success([
                'user' => $user,
                'token' => $user->createToken('Api Token of' . $user->name)->plainTextToken
            ]);
        } else {
            return response()->json([
                'status' => 'Error',
                'message' => 'Error',
                'data' => [
                    'user' => [
                        'id' => '',
                        'name' => '',
                        'emai' => ''
                    ],
                    'token' => '',
                ]
            ]);
        }
    }
    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as' => 0
        ]);
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Api Token of' . $user->name)->plainTextToken
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json('Logout Successfully');
    }
    public function profile()
    {
        $user = Auth::user();
        if ($user) {
            return response()->json([
                'success' => true,
                'data' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }
        // return response()->json(
        //     $user
        // );
    }
}
