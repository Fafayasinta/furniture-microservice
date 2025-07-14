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

Route::get('/', [LoginViewController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [LoginViewController::class, 'logout'])->name('logout');
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

// Route::prefix('admin/order')->controller(OrderController::class)->group(function () {
//     Route::get('/', 'index')->name('admin.orders.index');
//     Route::get('/list', 'list')->name('admin.orders.list');
//     Route::get('/{id}', 'show')->name('admin.orders.show');
//     Route::get('/{id}/verify', 'verify')->name('admin.orders.verify'); // hanya ubah status
//     Route::put('/{id}', 'updateStatus')->name('admin.orders.update');
//     Route::get('/{id}/confirm', 'confirm')->name('admin.orders.confirm');
//     Route::delete('/{id}', 'delete')->name('admin.orders.delete');
// });

// Order Admin (tanpa AJAX verify)
Route::prefix('admin/order')->name('admin.orders.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/list', [OrderController::class, 'list'])->name('list');
    Route::get('/{id}', [OrderController::class, 'show'])->name('show');
    Route::put('/{id}', [OrderController::class, 'updateStatus'])->name('updateStatus');
});








// routes/web.php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\LoginViewController;
// use App\Http\Controllers\OrderController;
// use App\Http\Controllers\ProductController;

// // Login
// Route::get('/', [LoginViewController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginViewController::class, 'login'])->name('login.submit');
// Route::post('/logout', [LoginViewController::class, 'logout'])->name('logout');

// // ✅ Semua route di bawah ini akan dilindungi middleware auth
// Route::middleware('auth')->group(function () {

//     Route::get('/admin/dashboard', [LoginViewController::class, 'dashboard'])->name('admin.dashboard');

//     Route::prefix('admin/product')->controller(ProductController::class)->group(function () {
//         Route::get('/', 'index')->name('admin.products.index');
//         Route::get('/list', 'list')->name('admin.products.list');
//         Route::get('/create', 'create')->name('admin.products.create');
//         Route::post('/', 'store')->name('admin.products.store');
//         Route::get('/{id}', 'show')->name('admin.products.show');
//         Route::get('/{id}/edit', 'edit')->name('admin.products.edit');
//         Route::put('/{id}', 'update')->name('admin.products.update');
//         Route::delete('/{id}', 'destroy')->name('admin.products.destroy');
//         Route::get('/{id}/confirm', 'confirm')->name('admin.products.confirm');
//     });

//     Route::prefix('admin/order')->controller(OrderController::class)->group(function () {
//         Route::get('/', 'index')->name('admin.orders.index');
//         Route::get('/list', 'list')->name('admin.orders.list');
//         Route::get('/{id}', 'show')->name('admin.orders.show');
//         Route::get('/{id}/verify', 'verify')->name('admin.orders.verify');
//         Route::post('/{id}/verify', 'verify_ajax')->name('admin.orders.verify_ajax');
//         Route::put('/{id}', 'updateStatus')->name('admin.orders.update');
//         Route::get('/{id}/confirm', 'confirm')->name('admin.orders.confirm');
//         Route::delete('/{id}', 'delete')->name('admin.orders.delete');
//     });
// });
