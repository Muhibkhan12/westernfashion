<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC PAGES (anyone can open these)
|--------------------------------------------------------------------------
*/

// "/" sends guests to the login page and logged-in users to the home page
Route::get('/', function () {
    return auth()->check() ? redirect('/home') : redirect()->route('login');
});

// Route::get("/home", [UserController::class, 'showHello'])->name('frontend-message');
Route::get('/home', function () {
    return view('index');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/products', function () {
    return view('products'); // the public shop page
});


/*
|--------------------------------------------------------------------------
| 2. AUTH (only for people who are NOT logged in)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');

    // Email verification code
    Route::get('/verify', [AuthController::class, 'showVerify'])->name('verify.show');
    Route::post('/verify', [AuthController::class, 'verify'])->name('verify.check')->middleware('throttle:10,1');
    Route::post('/verify/resend', [AuthController::class, 'resend'])->name('verify.resend')->middleware('throttle:3,1');

    // Google sign-in
    Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
});

// Logout (must be logged in)
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| 3. ADMIN PANEL (must be logged in AND have role = admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    // Static admin pages
    Route::get('/admin-dashboard', function () { return view('admin.dashboard'); });
    Route::get('/admin-orders', function () { return view('admin.orders'); });
    Route::get('/admin-inventory', function () { return view('admin.inventory'); });
    Route::get('/admin-customers', function () { return view('admin.customers'); });

    // Products CRUD  ->  /admin/products, /admin/products/create, /admin/products/5/edit ...
    // (the "admin" prefix keeps these away from the public /products page)
    Route::prefix('admin')->group(function () {
        Route::resource('products', ProductController::class)->except('show');

        // Delete one image from the edit page
        Route::delete('product-images/{image}', [ProductController::class, 'destroyImage'])
            ->name('product-images.destroy');
    });

    // Your old URLs still work (so your sidebar links don't break)
    Route::get('/admin-products', function () {
        return redirect()->route('products.index');
    });
    Route::get('/admin-add-products', function () {
        return redirect()->route('products.create');
    })->name('add-products');
});