<?php

use App\Http\Controllers\UserAuthController;
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


Route::middleware('auth:api')->group(function () {
    Route::post('/auth/logout', [UserAuthController::class, 'logout']);
    Route::post('/auth/refressh', [UserAuthController::class, 'refresh']);
});

Route::prefix('users')->group(function () {
    Route::get("/", [UserAuthController::class, "index"]);
    Route::post("/create", [UserAuthController::class, "create"]);
    Route::put('/update', [UserAuthController::class, 'update']);
    Route::put('/update/status', [UserAuthController::class, 'update']);
    Route::delete('/{id}/delete', [UserAuthController::class, 'disable']);

});
