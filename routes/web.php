<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\FoodController; // Controller untuk CRUD Admin
use App\Models\Food;


Route::get('/', function () {
    $foods = Food::latest()->take(8)->get();
    return view('home_guest', compact('foods'));
})->name('home.guest');

Route::get('/dashboard', function () {
    $foods = Food::latest()->take(8)->get();
    return view('home_user', compact('foods'));
})->middleware('auth')->name('home.user');
Auth::routes();

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::patch('/update-cart', [CartController::class, 'update'])->name('cart.update');
Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout-wa', [CartController::class, 'checkout'])->name('cart.checkout');


// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\FoodController::class, 'dashboard'])->name('dashboard');

    Route::middleware(['can:admin-access'])->group(function () {
        Route::resource('admin/foods', App\Http\Controllers\Admin\FoodController::class);

        // Route tambahan untuk manajemen stok
        Route::get('admin/stok', [App\Http\Controllers\Admin\FoodController::class, 'stokIndex'])->name('stok.index');
        Route::patch('admin/stok/{food}/update', [App\Http\Controllers\Admin\FoodController::class, 'stokUpdate'])->name('stok.update');
    });
});
