<?php

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

Route::get('/',[\App\Http\Controllers\Frontend\HomeController::class,'index'])->name('home');

Route::get('login',[\App\Http\Controllers\Frontend\LoginController::class,'login'])->name('login');
Route::post('login',[\App\Http\Controllers\Frontend\LoginController::class,'doLogin']);
Route::get('register',[\App\Http\Controllers\Frontend\LoginController::class,'register'])->name('register');
Route::post('register',[\App\Http\Controllers\Frontend\LoginController::class,'doRegister']);

Route::get('cart/add/{id}',[\App\Http\Controllers\Frontend\CartController::class,'addCart'])->name('cart.add');
Route::get('cart',[\App\Http\Controllers\Frontend\CartController::class,'index'])->name('cart');




Route::middleware('auth')->group(function (){

    Route::get('logout',[\App\Http\Controllers\Frontend\LoginController::class,'logout'])->name('logout');
    Route::get('profile',[\App\Http\Controllers\Frontend\LoginController::class,'profile'])->name('profile');
    Route::post('profile',[\App\Http\Controllers\Frontend\LoginController::class,'updateProfile']);
    Route::get('checkout',[\App\Http\Controllers\Frontend\OrderController::class,'checkout'])->name('checkout');
    Route::post('checkout',[\App\Http\Controllers\Frontend\OrderController::class,'order']);



    Route::prefix('dashboard')->middleware('isAdmin')->group(function (){
        Route::get('/',[\App\Http\Controllers\Backend\DashboardController::class,'Dashboard'])->name('dashboard');

        Route::get('/products',[\App\Http\Controllers\Backend\ProductController::class,'index'])->name('admin.product');
        Route::get('/products/create',[\App\Http\Controllers\Backend\ProductController::class,'create'])->name('admin.product.create');
        Route::post('/products/create',[\App\Http\Controllers\Backend\ProductController::class,'store']);
        Route::get('/products/edit/{id}',[\App\Http\Controllers\Backend\ProductController::class,'edit'])->name('admin.product.edit');
        Route::post('/products/edit/{id}',[\App\Http\Controllers\Backend\ProductController::class,'update']);
        Route::get('/products/delete/{id}',[\App\Http\Controllers\Backend\ProductController::class,'delete'])->name('admin.product.delete');
    });
});








