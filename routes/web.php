<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [ProductsController::class, 'index']);
Route::get('products', [ProductsController::class, 'index']);
Route::get('product_specifications/{id}', [ProductsController::class, 'product_specifications']);
Route::get('checkout',[ProductsController::class, 'check-out']);
Route::post('checkout','App\Http\Controllers\ProductsController@afterpayment')->name('checkout.credit-card');
