<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Admin\FoodController; // Controller untuk CRUD Admin
use App\Models\Food;


Route::get('/', function () {
    // Tampilkan menu terlaris yang belum expired
    $foods = Food::where('is_expired', false)->orderBy('terjual', 'desc')->take(6)->get();
    return view('home_guest', compact('foods'));
})->name('home.guest');

Route::get('/home', function () {
    // Tampilkan menu terbaru yang belum expired
    $foods = Food::where('is_expired', false)->latest()->take(9)->get();
    return view('home_user', compact('foods'));
})->middleware('auth')->name('home.user');

// Menu Routes (Untuk User)
Route::middleware(['auth'])->group(function () {
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.all');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/update-cart', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');

    // PINDAHKAN ROUTE PO KESINI AGAR BISA DIAKSES USER
    Route::post('/preorder', [App\Http\Controllers\CartController::class, 'storePreOrder'])->name('preorder.store');
});

Auth::routes();

// Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::middleware(['can:admin-access'])->group(function () {
        Route::get('/admin/dashboard', [App\Http\Controllers\Admin\FoodController::class, 'dashboard'])->name('dashboard');
        Route::resource('admin/foods', App\Http\Controllers\Admin\FoodController::class);
        Route::get('admin/stok', [App\Http\Controllers\Admin\FoodController::class, 'stokIndex'])->name('stok.index');
        Route::patch('admin/stok/{food}/update', [App\Http\Controllers\Admin\FoodController::class, 'stokUpdate'])->name('stok.update');
        Route::post('/admin/foods/check-expired', [App\Http\Controllers\Admin\FoodController::class, 'checkExpired'])->name('foods.check_expired');
        Route::post('/foods/{food}/restock', [FoodController::class, 'storeRestock'])->name('admin.foods.restock');

        // TAMBAHKAN ROUTE ADMIN UNTUK MANAJEMEN PRE-ORDER DISINI
        Route::get('/admin/preorders', [App\Http\Controllers\Admin\PreOrderController::class, 'index'])->name('admin.preorders.index');
        Route::get('/admin/preorders/{id}', [App\Http\Controllers\Admin\PreOrderController::class, 'show'])->name('admin.preorders.show');
        Route::get('/admin/preorders/{id}/print', [App\Http\Controllers\Admin\PreOrderController::class, 'print'])->name('admin.preorders.print');
        Route::patch('/admin/preorders/{id}/status', [App\Http\Controllers\Admin\PreOrderController::class, 'updateStatus'])->name('admin.preorders.update_status');
    });
});
