<?php

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
    Route::get('/user', \App\Http\Controllers\API\User\IndexController::class);
    Route::get('/chats/{chat}', \App\Http\Controllers\API\Chat\ShowController::class);
    Route::post('/messages/{chat}', \App\Http\Controllers\API\Message\StoreController::class);
});
