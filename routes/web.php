<?php

use App\Http\Controllers\Admin\BankController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
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

    Route::get('roles', [AdminRoleController::class, 'index']);
    Route::get('roles/create', [AdminRoleController::class, 'create']);
    Route::post('roles/store', [AdminRoleController::class, 'store']);
    Route::get('roles/show/{id}', [AdminRoleController::class, 'show']);
    Route::get('roles/edit/{id}', [AdminRoleController::class, 'edit']);
    Route::post('roles/update/{id}', [AdminRoleController::class, 'update']);
    Route::delete('roles/delete/{id}', [AdminRoleController::class, 'destroy']);

    Route::get('dashboard', [DashboardController::class, 'index']);
    // Category Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/edit/{category}', 'edit');
        Route::put('/category/{category}', 'update');
    });
    // Rental Route
    Route::controller(RentalController::class)->group(function () {
        Route::get('/rentals', 'index');
        Route::get('/rentals/create', 'create');
        Route::post('/rentals', 'store');
        Route::get('/rentals/edit/{rental}', 'edit');
        Route::put('/rentals/{rental_id}', 'update');
    });
    // Bank Route
    Route::controller(BankController::class)->group(function () {
        Route::get('/banks', 'index');
        Route::get('/banks/create', 'create');
        Route::post('/banks', 'store');
        Route::get('/banks/edit/{rental}', 'edit');
        Route::put('/banks/{rental_id}', 'update');
    });
    // Pertner Route
    Route::controller(PartnerController::class)->group(function () {
        Route::get('/partners', 'index');
        Route::post('/partners', 'store');
        Route::put('/partners/{partner_id}', 'update');
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
        Route::post('/users/{user}', 'update');
        Route::get('/users/active/{user_id}', 'active');
        Route::get('/users/nonactive/{user_id}', 'nonactive');
        Route::get('/drivers', 'driver');
        Route::get('/admins', 'admin');
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
        // Sales
        Route::get('/transactions/sales', 'sales');
    });
    // Order Route
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/create', 'create');
        Route::post('/orders', 'store');
        Route::get('/orders/detail/{id}', 'show')->name('show');
        Route::get('/orders/delete/{id}', 'destroy')->name('destroy');
        Route::get('/orders/create/order_item/{id}', 'add_order_item')->name('add_order_item');
        Route::post('/orders/create/store_order_item/', 'store_order_item')->name('store_order_item');
        Route::get('/orders/edit/edit_item/{item_id}', 'edit_item')->name('edit_item');
        Route::post('/orders/update_item/{order_item_id}', 'update_item')->name('update_item');
        Route::get('/orders/delete_item/{order_item_id}', 'destroy_item')->name('destroy_item');


        Route::get('/orders/payment/{order_id}', 'payment')->name('payment');
        Route::post('/orders/payment/add_payment', 'add_payment')->name('add_payment');
        // Sales
        Route::get('/orders/sales/', 'sales')->name('sales');
        Route::get('/orders/sales_items/', 'sales_item')->name('sales_item');

        Route::get('/orders/download/{order_id}', 'download')->name('download');
    });

    // Reports Route
    Route::controller(ReportController::class)->group(function () {
        Route::get('/reports', 'index');
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
