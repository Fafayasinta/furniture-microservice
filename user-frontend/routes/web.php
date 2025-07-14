<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserOrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Halaman form pemesanan
Route::get('/order', [UserOrderController::class, 'showForm'])->name('user.order.form');

// Proses submit pesanan
Route::post('/order', [UserOrderController::class, 'store'])->name('order.store');

// Halaman utama redirect ke form
Route::get('/', function () {
    return redirect()->route('user.order.form');
});
