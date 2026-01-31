<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\FoodController; // Controller untuk CRUD Admin
use App\Models\Food;

Route::get('/', function () {
    $foods = Food::all();
    return view('welcome', compact('foods'));
});

Auth::routes();

// Route User (Keranjang)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::patch('/update-cart', [CartController::class, 'update'])->name('cart.update');
Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout-wa', [CartController::class, 'checkout'])->name('cart.checkout');

// Semua yang ada di dalam group ini butuh login
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\Admin\FoodController::class, 'dashboard'])->name('home');
    Route::resource('admin/foods', App\Http\Controllers\Admin\FoodController::class);
});
