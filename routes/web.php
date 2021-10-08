<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TestimonialsController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('categories', CategoriesController::class)->middleware('auth');
Route::get('products/available', [ProductsController::class, 'available'])->name('products.available')->middleware('auth');
Route::get('products/unavailable', [ProductsController::class, 'unavailable'])->name('products.unavailable')->middleware('auth');
Route::resource('products', ProductsController::class)->middleware('auth');
Route::resource('products.images', ImagesController::class)->only(['edit', 'update', 'destroy'])->middleware('auth');
Route::resource('testimonials', TestimonialsController::class)->middleware('auth');
