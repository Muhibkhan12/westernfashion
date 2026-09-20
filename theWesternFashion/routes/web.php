<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('login');
});

// Route::get("/home", [UserController::class, 'showHello'])->name('frontend-message');
Route::get('/home', function () {
    return view('index');
});
Route::get('/about', function(){
    return view(
        'about'
    );
});
Route::get('/contact', function(){
    return view(
        'contact'
    );
});
Route::get('/products', function(){
    return view(
        'products'
    );
});
Route::get('/admin-dashboard', function(){return view('admin.dashboard');});
Route::get('/admin-orders', function(){return view('admin.orders');});
Route::get('/admin-inventory', function(){return view('admin.inventory');});
Route::get('/admin-customers', function(){return view('admin.customers');});
Route::get('/admin-products', function(){return view('admin.products');});