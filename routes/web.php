<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FactorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Models\Factor;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
});


Route::view('/login', 'authorize.login')->name('login');

Route::view('/register', 'authorize.register')->name('register');

Route::get('/workplace', function () {
    $customer_count = User::count();
    $factor_count = Factor::count();
    $order_count = Order::count();
    $product_count = Product::count();
    return view('workplace', compact('customer_count', 'factor_count', 'order_count', 'product_count'));
})->name('workplace')->middleware('auth:sanctum');

Route::get('/error/', function () {
//    dd('kkk');
    return view('error');
})->name('error');

//users

Route::middleware('auth:sanctum')->middleware('role:admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/filter', [UserController::class, 'filter'])->name('users.filter');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('users/status', [UserController::class, 'status'])->name('users.status');
    Route::get('users/confirmed/{user}', [UserController::class, 'confirmed'])->name('users.confirmed');
});
Route::post('/users/register', [UserController::class, 'UserRegister'])->name('users.register');
Route::any('/users/login', [UserController::class, 'UserLogin'])->name('users.login');
//Route::get('/users/logout', [UserController::class, 'UserLogout'])->name('users.logout');

//products
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware('role:admin,seller');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware('role:admin,seller');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware('role:admin,seller');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware('role:admin,seller');
    Route::patch('/products/{id}', [ProductController::class, 'update'])->name('products.update')->middleware('role:admin,seller');
    Route::delete('/products/{id}/delete', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('role:admin,seller');
    Route::get('/product/filter', [ProductController::class, 'filter'])->name('products.filter');
});

//orders
Route::middleware('auth:sanctum', 'role:admin,seller,customer')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::patch('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{id}/delete', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('orders/filter', [OrderController::class, 'filter'])->name('orders.filter');


});

Route::middleware('auth:sanctum', 'role:admin')->group(function () {
    Route::get('/factors', [FactorController::class, 'index'])->name('factors.index');
    Route::get('/factors/create', [FactorController::class, 'create'])->name('factors.create');
    Route::post('/factors', [FactorController::class, 'store'])->name('factors.store');
    Route::delete('/factors/{factor}/delete', [FactorController::class, 'destroy'])->name('factors.destroy');
    Route::get('/factors/{factor}/edit', [FactorController::class, 'edit'])->name('factors.edit');
    Route::put('/factors/{factor}', [FactorController::class, 'update'])->name('factors.update');
    Route::get('/factors/trashed', [FactorController::class, 'trashed'])->name('factors.trashed');
    Route::post('/factors/{id}/recovery', [FactorController::class, 'recovery'])->name('factors.recovery');
});

Route::get('/search', [SearchController::class, 'search'])->name('search.all');
Route::get('products/search', [SearchController::class, 'product'])->name('product.search');


Route::get('/send/email', [EmailController::class, 'index'])->name('email.send');
//Route::get('/send-mail', [EmailController::class, 'index'])->name('send');

Route::get('/login/{provider}', [AuthController::class, 'redirectToProvider'])->name('provider.login');
Route::get('/login/{provider}/callback', [AuthController::class, 'handleProviderCallback']);




