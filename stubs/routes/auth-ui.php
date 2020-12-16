<?php

use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterController::class, 'register'])->middleware(['guest'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->middleware(['guest'])->name('login');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->middleware(['guest'])->name('password.email');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->middleware(['guest'])->name('password.update');
Route::get('/verify-email/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['auth:sanctum', 'signed', 'throttle:6,1'])->name('verification.verify');
Route::post('/email/verification-notification', [VerificationController::class, 'resend'])->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.resend');
Route::post('/user/confirm-password', [ConfirmPasswordController::class, 'confirm'])->middleware(['auth:sanctum']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware(['auth:sanctum'])->name('logout');
