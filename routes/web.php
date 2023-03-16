<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', \App\Http\Controllers\Auth\LoginController::class);
Route::post('/sign-up', \App\Http\Controllers\Auth\RegisterController::class);

Route::view('/{page}', 'app')->where('page', '.*');
