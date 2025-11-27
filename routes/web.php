<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/market/home', function () {
    return view('market.home');
});
Route::get('/market/about', function () {
    return view('market.about');
});
Route::get('/market/menu', function () {
    return view('market.menu');
});
// Route::post('/market/order', function () {
//     return view('market.order');



Route::get('/market/order', function () {
    return view('market.order');
});

// Route::get('/market/order', [TokoController::class, 'index'])->name('market.index');
// Route::post('/market/order', [TokoController::class, 'index'])->name('market.index');
Route::post('/market/order', [TokoController::class, 'store'])->name('market.store');

