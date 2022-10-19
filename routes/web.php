<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductVariationtController;

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

Route::get('/dashboard', [ProductController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/product/create', [ ProductController::class, 'create' ])->middleware(['auth', 'verified'])->name('create_product');
Route::post('/dashboard/product/store', [ ProductController::class, 'store' ])->middleware(['auth', 'verified'])->name('store_product');
Route::get('/dashboard/product/show/{id}', [ ProductController::class, 'show' ])->middleware(['auth', 'verified'])->name('show_product');
Route::get('/dashboard/product/edit/{id}', [ ProductController::class, 'edit' ])->middleware(['auth', 'verified'])->name('edit_product');
Route::post('/dashboard/product/update/{id}', [ ProductController::class, 'update' ])->middleware(['auth', 'verified'])->name('update_product');
Route::get('/dashboard/product/destroy/{id}', [ ProductController::class, 'destroy' ])->middleware(['auth', 'verified'])->name('delete_product');


Route::get('/dashboard/variants', [ ProductVariationtController::class, 'index' ])->middleware(['auth', 'verified'])->name('variants');
Route::get('/dashboard/variant/create', [ ProductVariationtController::class, 'create' ])->middleware(['auth', 'verified'])->name('create_variant');
Route::get('/dashboard/variant/store', [ ProductVariationtController::class, 'store' ])->middleware(['auth', 'verified'])->name('store_variants');
Route::get('/dashboard/variant/update/{id}', [ ProductVariationtController::class, 'update' ])->middleware(['auth', 'verified'])->name('update_variants');
Route::get('/dashboard/variant/destroy/{id}', [ ProductVariationtController::class, 'destroy' ])->middleware(['auth', 'verified'])->name('delete_variation');


Route::get('/dashboard/categories', [ CategoryController::class, 'index' ])->middleware(['auth', 'verified'])->name('index_categories');
Route::get('/dashboard/categories/main', [ CategoryController::class, 'main_index' ])->middleware(['auth', 'verified'])->name('get_all_products');
Route::get('/dashboard/category/show/{id}', [ CategoryController::class, 'show' ])->middleware(['auth', 'verified'])->name('get_category_products');
Route::get('/dashboard/category/edit/{id}', [ CategoryController::class, 'edit' ])->middleware(['auth', 'verified'])->name('edit_category');
Route::post('/dashboard/category/store', [ CategoryController::class, 'store' ])->middleware(['auth', 'verified'])->name('store_category');
Route::get('/dashboard/category/delete/{id}', [ CategoryController::class, 'destroy' ])->middleware(['auth', 'verified'])->name('delete_category');
Route::post('/dashboard/category/update/{id}', [ CategoryController::class, 'update' ])->middleware(['auth', 'verified'])->name('update_category');

require __DIR__.'/auth.php';
