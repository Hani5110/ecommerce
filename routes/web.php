<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});


Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);