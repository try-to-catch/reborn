<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', \App\Http\Controllers\Auth\LoginController::class)->middleware('guest');
Route::post('/sign-up', \App\Http\Controllers\Auth\RegisterController::class)->middleware('guest');
Route::post('/forgot-password', \App\Http\Controllers\Auth\ForgotPasswordController::class)->middleware('guest');
Route::post('/reset-password', \App\Http\Controllers\Auth\ResetPasswordController::class)->middleware('guest');

Route::view('/{page}', 'app')->where('page', '.*');
