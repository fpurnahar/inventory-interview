<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/')->group(function () {
    Route::get('', [ProductController::class, 'index'])->name('home');
    Route::post('store', [ProductController::class, 'store'])->name('store');
    Route::get('search', [ProductController::class, 'search'])->name('search');
    Route::get('edit/{product}', [ProductController::class, 'edit'])->name('edit');
    Route::patch('update/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('delete/{id}', [ProductController::class, 'destroy'])->name('delete');
});
