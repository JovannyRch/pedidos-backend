<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderProductsController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/users', [UserController::class, 'create']);
Route::get('/users', [UserController::class,'users']);
Route::post('/login', [ApiController::class,'login']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::post('/posts', [PostController::class, 'create']);

Route::get('/udetails', [UserDetailController::class, 'index']);
Route::get('/udetails/{id}', [UserDetailController::class, 'show']);
Route::post('/udetails', [UserDetailController::class, 'create']);
Route::put('/udetails/{id}', [UserDetailController::class, 'update']);
Route::delete('/udetails/{id}', [UserDetailController::class, 'destroy']);

Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::post('/orders', [OrderController::class, 'create']);
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

Route::get('/products', [ProductController::class, 'index']);
//Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'create']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

Route::get('/oproducts', [OrderProductsController::class, 'index']);
Route::get('/oproducts/{id}', [OrderProductsController::class, 'show']);
Route::post('/oproducts', [OrderProductsController::class, 'create']);
Route::put('/oproducts/{id}', [OrderProductsController::class, 'update']);
Route::delete('/oproducts/{id}', [OrderProductsController::class, 'destroy']);

Route::get('/user-count', [APIController::class, 'getUserCount']);
Route::get('/product-count', [APIController::class, 'getProductCount']);
Route::get('/order-count', [APIController::class, 'getOrderCount']);
