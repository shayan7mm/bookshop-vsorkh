<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MagazineController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/deals', [ShopController::class, 'deals'])->name('deals');
Route::get('/audiobooks', [ShopController::class, 'audiobooks'])->name('audiobooks');


Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/api/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::get('/book/{book}', [BookController::class, 'show'])->name('book.show');
Route::get('/magazine', [MagazineController::class, 'index'])->name('magazine.index');
Route::get('/magazine/{magazine}', [MagazineController::class, 'show'])->name('magazine.show');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login/send-otp', [AuthController::class, 'sendOtp'])->name('otp.send');
Route::post('/login/verify', [AuthController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/orders', [HomeController::class, 'index'])->name('orders');
Route::post('/login/reset', [AuthController::class, 'resetOtp'])->name('otp.reset');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'form'])->name('checkout');
    Route::post('/checkout/pay', [CheckoutController::class, 'pay'])->name('checkout.pay');
    Route::get('/orders', [CheckoutController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [CheckoutController::class, 'show'])->name('orders.show');
});