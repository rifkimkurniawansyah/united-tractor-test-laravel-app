<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;

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

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);

// Route::controller(AuthController::class)->group(function () {
//     Route::post('/logout', 'logout');
// });

Route::middleware('auth:api')->group(function(){
    //Endpoint Untuk Mengelola Category Product
    Route::get('/category-products', [CategoryProductController::class,'index']);
    Route::get('/category-products/{id}', [CategoryProductController::class,'show']);
    Route::put('/category-products/{id}', [CategoryProductController::class,'update']);
    Route::post('/category-products', [CategoryProductController::class,'store']);
    Route::delete('/category-products/{id}', [CategoryProductController::class,'destroy']);

    //Endpoint Untuk Mengelola Product
    Route::get('/products', [ProductController::class,'index']);
    Route::get('/products/{id}', [ProductController::class,'show']);
    Route::put('/products/{id}', [ProductController::class,'update']);
    Route::post('/products', [ProductController::class,'store']);
    Route::delete('/products/{id}', [ProductController::class,'destroy']);
});
