<?php

use App\Http\Controllers\API\Chat\ChatRequestController;
use App\Http\Controllers\API\Chat\IndexController;
use App\Http\Controllers\API\Chat\ShowController;
use App\Http\Controllers\API\Message\StoreController;
use App\Http\Controllers\API\User\SearchController;
use Illuminate\Http\Request;
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
Route::middleware('auth:sanctum')->group(function (){
    Route::prefix('/users')->group(function (){
        Route::get('/me', \App\Http\Controllers\API\User\IndexController::class);
        Route::post('/search', SearchController::class);
    });

    Route::post('/messages/{chat}', StoreController::class);

    Route::prefix('/chats')->group(function (){
        Route::get('/', IndexController::class);
        Route::get('/{chat}', ShowController::class);
        Route::post('/chat-request', ChatRequestController::class);
    });
});
