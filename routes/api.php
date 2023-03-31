<?php

use App\Http\Controllers\API\Chat\IndexController;
use App\Http\Controllers\API\Chat\ShowController;
use App\Http\Controllers\API\Message\StoreController;
use App\Http\Controllers\API\User\SearchController;
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
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/users')->group(function () {
        Route::get('/me', \App\Http\Controllers\API\User\IndexController::class);
        Route::post('/search', SearchController::class);
    });

    Route::post('/messages/{chat}', StoreController::class);

    Route::prefix('/chats')->group(function () {
        Route::prefix('/chat-requests')->group(function () {
            Route::get('/', \App\Http\Controllers\API\ChatRequest\IndexController::class);
            Route::post('/', \App\Http\Controllers\API\ChatRequest\StoreController::class);
            Route::patch('/{chatRequest}', \App\Http\Controllers\API\ChatRequest\UpdateController::class);
        });

        Route::get('/', IndexController::class);
        Route::get('/{chat}', ShowController::class);
    });
});
