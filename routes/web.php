<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\OrderController;

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

/*
|--------------------------------------------------------------------------
| Orders
|--------------------------------------------------------------------------
*/

/* STATUS FILTER */
Route::get('/admin/orders/status/{status}', [OrderController::class,'status'])
->name('admin.orders.filter');

/* STATUS UPDATE */
Route::put('/admin/orders/{id}/status', [OrderController::class,'updateStatus'])
->name('admin.orders.updateStatus');

/* ORDERS LIST */
Route::get('/admin/orders', [OrderController::class,'index'])
->name('admin.orders');

/* ORDER DETAIL */
Route::get('/admin/orders/{id}', [OrderController::class,'show'])
->name('admin.orders.show');

/* DELETE ORDER */
Route::delete('/admin/orders/{id}', [OrderController::class,'destroy'])
->name('admin.orders.delete');

/*
|--------------------------------------------------------------------------
| Products & Categories
|--------------------------------------------------------------------------
*/

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);