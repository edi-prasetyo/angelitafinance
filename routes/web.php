<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\TimerController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [HomeController::class, 'index']);

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index']);
    // Category Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/edit/{category}', 'edit');
        Route::put('/category/{category}', 'update');
    });
    // Brand Route
    Route::controller(BrandController::class)->group(function () {
        Route::get('/brands', 'index');
        Route::get('/brands/create', 'create');
        Route::post('/brands', 'store');
        Route::get('/brands/edit/{brand}', 'edit');
        Route::put('/brands/{brand}', 'update');
    });
    // Car Route
    Route::controller(CarController::class)->group(function () {
        Route::get('/cars', 'index');
        Route::get('/cars/create', 'create');
        Route::post('/cars', 'store');
        Route::get('/cars/edit/{car}', 'edit');
        Route::put('/cars/{car}', 'update');
    });
    // Product Route
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products', 'store');
        Route::get('/products/edit/{product}', 'edit');
        Route::put('/products/{product}', 'update');
        Route::get('/product-image/delete/{product_image_id}', 'destroyImage');
        Route::get('/products/delete/{product_id}', 'destroy');
    });
    // Product Route
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customers', 'index');
        Route::get('/customers/create', 'create');
        Route::post('/customers', 'store');
        Route::get('/customers/edit/{customer}', 'edit');
        Route::put('/customers/{customer}', 'update');
        Route::delete('/customers/delete/{customer_id}', 'destroy');

        Route::get('/customers/calling', 'calling');
        Route::get('/customers/read/{customer_id}', 'update_read');
        Route::get('/customers/gift', 'gift');
        Route::get('/customers/gift/{customer_id}', 'update_gift');
    });
    // Timer Route
    Route::controller(TimerController::class)->group(function () {
        Route::get('/timers', 'index');
        Route::get('/timers/create', 'create');
        Route::post('/timers', 'store');
        Route::get('/timers/edit/{timer_id}', 'edit');
        Route::put('/timers/{timer}', 'update');
        Route::delete('/timers/delete/{customer_id}', 'destroy');
    });
    // User Route
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users', 'store');
        Route::get('/users/edit/{user}', 'edit');
        Route::put('/users/{user}', 'update');
        Route::get('/users/delete/{user_id}', 'destroy');
        Route::get('/drivers', 'driver');
        Route::get('/finances', 'finance');
        Route::get('/security', 'security');
    });
    // Package Route
    Route::controller(PackageController::class)->group(function () {
        Route::get('/packages', 'index');
        Route::get('/packages/create', 'create');
        Route::post('/packages', 'store');
        Route::get('/packages/edit/{package}', 'edit');
        Route::put('/packages/{package}', 'update');
        Route::get('/packages/delete/{package_id}', 'destroy');
    });
    // Transaction Route
    Route::controller(TransactionController::class)->group(function () {
        Route::get('/transactions', 'index');
        Route::get('/transactions/create', 'create');
        Route::post('/transactions', 'store');
        Route::get('/transactions/edit/{transaction}', 'edit');
        Route::put('/transactions/add_schedule/{transaction_id}', 'add_schedule');
        Route::get('/transactions/detail/{transaction_id}', 'detail');
        Route::put('/transactions/{transaction}', 'update');
        Route::get('/transactions/delete/{transaction_id}', 'destroy');
        Route::get('transactions/autocomplete/', 'autocomplete')->name('autocomplete');
    });
    // Schedule Route
    Route::controller(ScheduleController::class)->group(function () {
        Route::get('/schedules', 'index');
        Route::get('/schedules/create', 'create');
        Route::post('/schedules', 'store');
        Route::get('/schedules/add/{schedule}', 'add_item');
        Route::post('/schedules/add', 'add');
        Route::get('/schedules/edit/{schedule}', 'edit');
        Route::put('/schedules/{schedule}', 'update');
        Route::get('/schedules/delete/{schedule_id}', 'destroy');
        Route::get('/schedules/accept/{transaction_id}', 'accept');
        Route::get('/schedules/on_road/{transaction_id}', 'on_road');
        Route::put('/schedules/finish/{transaction_id}', 'finish');
        Route::get('/schedules/detail/{schedule_item_id}', 'show');
        Route::get('/schedules/additional/{transaction_id}', 'additional');
    });
});
