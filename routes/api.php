<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrderController;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);




// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout');
        Route::get('/profile', 'profile');
    });
    // Orders
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/unpaid', 'unpaid');
        Route::get('/orders/paid', 'paid');
        Route::get('/orders/cancel',  'cancel');
        Route::get('/orders/verify',  'verify');
        Route::get('/orders/verify/{id}',  'verify_order');
        Route::get('/orders/all', 'get_orders');
        Route::get('/orders/{id}',  'show');
        Route::get('/orders/payments/{order_id}', 'get_payments');
    });

    Route::get('/customers', [CustomerController::class, 'index']);
});

// Test Response Sanctum Api
// Route::post('/sanctum/token', function (Request $request) {
//     $request->validate([
//         'email' => 'required|email',
//         'password' => 'required',
//         'device_name' => 'required',
//     ]);

//     $user = User::where('email', $request->email)->first();
//     if (!$user || !Hash::check($request->password, $user->password)) {
//         throw ValidationException::withMessages([
//             'email' => ['the provided credential are incorrect'],
//         ]);
//     }
//     return $user->createToken($request->device_name)->plainTextToken;
// });
