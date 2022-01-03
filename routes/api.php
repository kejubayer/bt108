<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('products/',[\App\Http\Controllers\Api\ProductController::class,'index']);
Route::get('products/{id}',[\App\Http\Controllers\Api\ProductController::class,'show']);
Route::post('products/create',[\App\Http\Controllers\Api\ProductController::class,'store']);
Route::post('products/edit/{id}',[\App\Http\Controllers\Api\ProductController::class,'update']);
Route::get('products/delete/{id}',[\App\Http\Controllers\Api\ProductController::class,'delete']);
