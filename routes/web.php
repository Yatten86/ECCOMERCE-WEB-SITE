<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


Route::middleware(['guestOrVerified'])->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('home');
    Route::get('/products/{product:slug}', [ProductController::class, 'view'])->name('product.view');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::prefix('/cart')->name('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::get('/add/{product:slug}', [CartController::class, 'add'])->name('add');
        Route::get('/remove/{product:slug}', [CartController::class, 'remove'])->name('remove');
        Route::get('/update-quantity/{product:slug}', [CartController::class, 'updateQuantity'])->name('update-quantity');
    });
});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });





require __DIR__ . '/auth.php';
