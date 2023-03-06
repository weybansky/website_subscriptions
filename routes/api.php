<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\WebsiteController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('users')->group(function () {
    Route::post("/", [UserController::class, 'store']);
});


Route::prefix('websites')->group(function () {
    Route::post("/", [WebsiteController::class, 'store']);

    Route::post("{website}/posts", [WebsiteController::class, 'storePost']);

    Route::post("{website}/subscribe", [WebsiteController::class, 'subscribeUser']);
});
