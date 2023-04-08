<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class)->middleware('guest');
Route::post('/sign-up', RegisterController::class)->middleware('guest');
Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');
Route::post('/forgot-password', ForgotPasswordController::class)->middleware('guest');
Route::post('/reset-password', ResetPasswordController::class)->middleware('guest');

Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::view('/{page}', 'app')->where('page', '.*');
