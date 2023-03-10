<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdCategoriesController;
use App\Http\Controllers\Controllers;
use Illuminate\Http\Request;

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
Route::get('/',[ProdCategoriesController::class,'getProdCategories']);
Route::get('/product/{category}',[ProdCategoriesController::class, 'getProducts'])->name('product');
Route::get('/product_form',[ProdCategoriesController::class, 'addNewProductForm'])->name('product_form');
Route::get('/add_product',[ProdCategoriesController::class, 'addNewProduct']);
Route::get('/add_category',[ProdCategoriesController::class, 'addNewCategory'])->name('add_category');
Route::get('/products_for_sale/{category}',[ProdCategoriesController::class, 'ProductsForSale'])->name('products_for_sale');
Route::get('/products_for_sale_list/{category}',[ProdCategoriesController::class, 'ProductsForSaleList'])->name('products_for_sale_list');
Route::get('/add_successfull', function () {
    return view('add_successfull');
});

Route::get('/logout',[Controllers::class,'logout']);

Route::get('/dashboard', function (Request $req) {
    //$req->session()->put('user', $user);
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
