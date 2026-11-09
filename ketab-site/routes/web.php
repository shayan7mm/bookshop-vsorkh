<?php
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [HomeController::class, 'index'])->name('shop');
Route::get('/deals', [HomeController::class, 'index'])->name('deals');
Route::get('/audiobooks', [HomeController::class, 'index'])->name('audiobooks');
Route::get('/cart', [HomeController::class, 'index'])->name('cart');
Route::get('/book/{book}', [HomeController::class, 'index'])->name('book.show');
Route::get('/magazine', [HomeController::class, 'index'])->name('magazine.index');
Route::get('/magazine/{magazine}', [HomeController::class, 'index'])->name('magazine.show');