<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsCartContoller;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\TransactionsController;

Auth::routes();

//LANDING PAGE
Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index'])->name('home');

//CART
Route::get('cart', [ProductsCartContoller::class, 'index'])->name('cart.index')->middleware('auth');
Route::post('cart/categories/{category}/products/{product}', [ProductsCartContoller::class, 'store'])->name('cart.store')->middleware('auth');
Route::put('cart/categories/{category}/products/{product}', [ProductsCartContoller::class, 'update'])->name('cart.update')->middleware('auth');
Route::delete('cart/categories/{category}/products/{product}', [ProductsCartContoller::class, 'destroy'])->name('cart.delete')->middleware('auth');

//CATEGORIES
Route::resource('categories', CategoriesController::class)->middleware('auth');

//CITIES
Route::resource('cities', CitiesController::class)->middleware('auth');

//CATEGORIES.PRODUCTS
Route::resource('categories.products', CategoryProductController::class)->only('index', 'show');

//PRODUCTS
Route::get('products/unavailable', [ProductsController::class, 'unavailable'])->name('products.unavailable')->middleware('auth');
Route::get('products/available', [ProductsController::class, 'available'])->name('products.available')->middleware('auth');
Route::resource('products', ProductsController::class)->middleware('auth');
Route::resource('products.images', ImagesController::class)->only(['edit', 'update', 'destroy'])->middleware('auth');
//Testimonials
Route::resource('testimonials', TestimonialsController::class)->middleware('auth');



