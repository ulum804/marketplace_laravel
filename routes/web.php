<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;

Route::get('/', function () {
    return view('market.home');
});

Route::prefix('market')->group(function () {

    Route::get('/home', fn () => view('market.home'));
    Route::get('/about', fn () => view('market.about'));

    Route::get('/menu', [ProdukController::class, 'index'])
        ->name('market.menu');

    Route::get('/order', function () {
        $produk = \App\Models\ProdukModel::all();
        $produkMap = \App\Models\ProdukModel::pluck('nama_produk', 'id');
        return view('market.order', compact('produk', 'produkMap'));
    });

    Route::post('/store', [TokoController::class, 'store'])
        ->name('market.store');
});

Route::get('/api/products', [ProdukController::class, 'index'])
    ->name('api.products');



Route::prefix('admin')->group(function () {

    /* ======================
     |  AUTH
     ====================== */
    Route::get('/login', fn () => view('admin.login'))
        ->name('admin.login');

    Route::post('/login', [UserController::class, 'login'])
        ->name('admin.login.post');

    Route::get('/register', [UserController::class, 'showRegisterForm'])
        ->name('admin.register');

    Route::post('/register', [UserController::class, 'store'])
        ->name('admin.register.post');


    /* ======================
     |  DASHBOARD
     ====================== */
    Route::get('/', [TokoController::class, 'index'])
        ->name('admin.admin');


    /* ======================
     |  ORDERS
     ====================== */
    Route::delete('/orders/{id}', [TokoController::class, 'destroy'])
        ->name('admin.orders.destroy');


    /* ======================
     |  PRODUCTS
     ====================== */
    Route::get('/products', [ProdukController::class, 'index'])
        ->name('admin.products.index');

    Route::post('/products', [ProdukController::class, 'store'])
        ->name('admin.products.store');

    Route::get('/products/{id}', [ProdukController::class, 'show'])
        ->name('admin.products.show');

    Route::put('/products/{id}', [ProdukController::class, 'update'])
        ->name('admin.products.update');

    Route::delete('/products/{id}', [ProdukController::class, 'destroy'])
        ->name('admin.products.destroy');


    /* ======================
     |  VOUCHERS
     ====================== */
    Route::get('/voucher', [VoucherController::class, 'index'])
        ->name('admin.voucher.index');

    Route::post('/voucher', [VoucherController::class, 'store'])
        ->name('admin.voucher.store');

    Route::delete('/voucher/{voucher}', [VoucherController::class, 'destroy'])
        ->name('admin.voucher.destroy');

    Route::patch('/voucher/{voucher}/toggle', [VoucherController::class, 'toggle'])
        ->name('admin.voucher.toggle');
    Route::put('/voucher/{voucher}', [VoucherController::class, 'update'])
    ->name('admin.voucher.update');

    

});