<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;

// --- PUBLIC ROUTES ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/my-orders', [HomeController::class, 'myOrders'])->name('my-orders')->middleware('auth');
Route::post('/buy-now/{product}', [HomeController::class, 'buyNow'])->name('buy-now')->middleware('auth');

// --- BREEZE PROFILE ROUTE ( profiles for customers and admins) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- ADMIN PANEL ROUTES ---
Route::middleware(['auth', 'verified', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('dashboard');

    // ALL ADMIN RESOURCES ARE NOW HERE
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

require __DIR__.'/auth.php';