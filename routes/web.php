<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\FoodController; // Controller untuk CRUD Admin
use App\Models\Food;

Route::get('/', function () {
    $foods = Food::take(4)->get(); // Mengambil rekomendasi makanan
    return view('welcome', compact('foods'));
})->name('landing');

Auth::routes();

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::patch('/update-cart', [CartController::class, 'update'])->name('cart.update');
Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout-wa', [CartController::class, 'checkout'])->name('cart.checkout');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    // Group khusus Admin
    Route::middleware(['can:admin-access'])->group(function () {
        Route::resource('admin/foods', App\Http\Controllers\Admin\FoodController::class);
    });
});
