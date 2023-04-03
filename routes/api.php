<?php

use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\Product\{GetProductListController,CreateProductController,
    UpdateProductController,DeleteProductController};
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/auth/register', [UserAuthController::class, 'register']);
Route::post('/auth/login', [UserAuthController::class, 'login']);

// USER MANAGEMENT
Route::prefix('users')->middleware('api')->group(function () {
    Route::get("/", [UserAuthController::class, "index"]);
    Route::post("/create", [UserAuthController::class, "create"]);
    Route::put('/update', [UserAuthController::class, 'update']);
    Route::put('/update/status', [UserAuthController::class, 'update']);
    Route::delete('/{id}/delete', [UserAuthController::class, 'disable']);

});

// PRODUCT MANAGEMENT
Route::prefix('products')->middleware('api')->group(function (){
    Route::get('/', GetProductListController::class);
    Route::post('/',CreateProductController::class);
    Route::post('/{id}',UpdateProductController::class);
    Route::delete('/{id}',DeleteProductController::class);
});