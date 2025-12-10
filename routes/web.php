<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('market.home');
});

Route::get('/market/home', function () {
    return view('market.home');
});
Route::get('/market/about', function () {
    return view('market.about');
});
Route::get('/market/menu', [ProdukController::class, 'index'])->name('market.menu');
// Route::post('/market/order', function () {
//     return view('market.order');



Route::get('/market/order', function () {
    $produk = \App\Models\ProdukModel::all();
    return view('market.order', compact('produk'));
});

// Route::get('/market/order', [TokoController::class, 'index'])->name('market.index');
// Route::post('/market/order', [TokoController::class, 'index'])->name('market.index');
Route::post('/market/store', [TokoController::class, 'store'])->name('market.store');
Route::post('/market/order', [ProdukController::class, 'index'])->name('market.order');

// Public product routes for menu page
Route::get('/api/products', [ProdukController::class, 'index'])->name('api.products');

Route::get('/admin', function () {
    return view('admin.admin');
});
Route::get('/admin', [TokoController::class, 'index'])->name('admin.admin');
Route::delete('/admin/orders/{id}', [TokoController::class, 'destroy'])->name('admin.orders.destroy');

// Product routes
Route::get('/admin/products', [ProdukController::class, 'index'])->name('admin.products.index');
Route::post('/admin/products', [ProdukController::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/{id}', [ProdukController::class, 'show'])->name('admin.products.show');
Route::put('/admin/products/{id}', [ProdukController::class, 'update'])->name('admin.products.update');
Route::delete('/admin/products/{id}', [ProdukController::class, 'destroy'])->name('admin.products.destroy');

Route::get('/login', function () {
    return view('admin.login');
});

Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

// Route::post('/admin/login', [UserController::class, 'login'])->name('admin.login.post');
Route::post('/admin/register', [UserController::class, 'register])'])->name('admin.register.post');
