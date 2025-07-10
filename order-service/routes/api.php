<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index']);             // Tampilkan semua pesanan
    Route::post('/', [OrderController::class, 'store']);            // Simpan pesanan baru
    Route::get('{id}', [OrderController::class, 'show']);           // Detail satu pesanan
    Route::put('{id}/status', [OrderController::class, 'updateStatus']); // Ubah status pesanan
    Route::delete('{id}', [OrderController::class, 'destroy']);     // Hapus pesanan
});
