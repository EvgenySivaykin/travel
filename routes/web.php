<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController as C;
use App\Http\Controllers\HotelController as H;
use App\Http\Controllers\FrontController as F;
use App\Http\Controllers\OrderController as O;

Route::get('/', [F::class, 'home'])->name('start')->middleware('roles:A|C');
Route::get('/hotel/{hotel}', [F::class, 'showHotel'])->name('show-hotel')->middleware('roles:A|C');
Route::get('/cat/{country}', [F::class, 'showCatHotels'])->name('show-cats-hotels')->middleware('roles:A|C');
Route::post('/add-to-cart', [F::class, 'addToCart'])->name('add-to-cart')->middleware('roles:A|C');
Route::get('/cart', [F::class, 'cart'])->name('cart')->middleware('roles:A|C');
Route::post('/cart', [F::class, 'updatecart'])->name('update-cart')->middleware('roles:A|C');
Route::post('/make-order', [F::class, 'makeOrder'])->name('make-order')->middleware('roles:A|C');

Route::prefix('admin/countries')->name('countries-')->group(function () {
    Route::get('/', [C::class, 'index'])->name('index')->middleware('roles:A');
    Route::get('/create', [C::class, 'create'])->name('create')->middleware('roles:A');
    Route::post('/create', [C::class, 'store'])->name('store')->middleware('roles:A');
    Route::get('/edit/{country}', [C::class, 'edit'])->name('edit')->middleware('roles:A');
    Route::put('/edit/{country}', [C::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{country}', [C::class, 'destroy'])->name('delete')->middleware('roles:A');
});

Route::prefix('admin/hotels')->name('hotels-')->group(function () {
    Route::get('/', [H::class, 'index'])->name('index')->middleware('roles:A');
    Route::get('/show/{hotel}', [H::class, 'show'])->name('show')->middleware('roles:A');
    Route::get('/pdf/{hotel}', [H::class, 'pdf'])->name('pdf')->middleware('roles:A');
    Route::get('/create', [H::class, 'create'])->name('create')->middleware('roles:A');
    Route::post('/create', [H::class, 'store'])->name('store')->middleware('roles:A');
    Route::get('/edit/{hotel}', [H::class, 'edit'])->name('edit')->middleware('roles:A');
    Route::put('/edit/{hotel}', [H::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{hotel}', [H::class, 'destroy'])->name('delete')->middleware('roles:A');
});

Route::prefix('admin/orders')->name('orders-')->group(function () {
    Route::get('/', [O::class, 'index'])->name('index')->middleware('roles:A');
    Route::put('/edit/{order}', [O::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{order}', [O::class, 'destroy'])->name('delete')->middleware('roles:A');
});

// Route::prefix('admin/orders')->name('orders-')->group(function () {
//     Route::get('/', [O::class, 'index'])->name('index');
//     Route::put('/edit/{order}', [O::class, 'update'])->name('update');
//     Route::delete('/delete/{order}', [O::class, 'destroy'])->name('delete');
// });



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');