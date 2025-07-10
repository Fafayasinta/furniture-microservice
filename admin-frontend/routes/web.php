<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginViewController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [LoginViewController::class, 'showLoginForm'])->name('login');
Route::get('/admin/dashboard', [LoginViewController::class, 'dashboard'])->name('admin.dashboard');

Route::prefix('admin/product')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('admin.products.index');
    Route::get('/list', 'list')->name('admin.products.list');
    Route::get('/create', 'create')->name('admin.products.create');
    Route::post('/', 'store')->name('admin.products.store');
    Route::get('/{id}', 'show')->name('admin.products.show');
    Route::get('/{id}/edit', 'edit')->name('admin.products.edit');
    Route::put('/{id}', 'update')->name('admin.products.update');
    Route::delete('/{id}', 'destroy')->name('admin.products.destroy');
    Route::get('/{id}/confirm', 'confirm')->name('admin.products.confirm');
});

Route::prefix('admin/order')->controller(OrderController::class)->group(function () {
    Route::get('/', 'index')->name('admin.orders.index');
    Route::get('/list', 'list')->name('admin.orders.list');
    Route::get('/{id}', 'show')->name('admin.orders.show');
    Route::get('/{id}/verify', 'verify')->name('admin.orders.verify'); // hanya ubah status
    Route::put('/{id}', 'updateStatus')->name('admin.orders.update');
    Route::get('/{id}/confirm', 'confirm')->name('admin.orders.confirm');
    Route::delete('/{id}', 'delete')->name('admin.orders.delete');
});




