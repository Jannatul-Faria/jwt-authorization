<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerifyMiddleware;
use Illuminate\Support\Facades\Route;

// ==============================================================================================
//                                   Page Routes
// ==============================================================================================
Route::view('/', 'frontend.pages.user.welcome');
Route::view('/login',  'frontend.pages.user.login-page');
Route::view('/registration', 'frontend.pages.user.registration-page');
Route::view('/sendOtp', 'frontend.pages.user.send-otp-page');
Route::view('/otpVerify', 'frontend.pages.user.verify-otp-page');
Route::view('/resetPassword', 'frontend.pages.user.reset-pass-page');
Route::view('/dashboard','dashboardPage')->Middleware([TokenVerifyMiddleware::class]);
Route::view('/logout','logout');
Route::view('/profile',  'profile')->Middleware([TokenVerifyMiddleware::class]);


// ==============================================================================================
//                                   Api Routes
// ==============================================================================================
Route::post('registration', [UserController::class, 'userRegistration']);
Route::post('login', [UserController::class, 'userLogin']);
Route::post('sendOtp', [UserController::class, 'sendOtp']);
Route::post('verifyOtp', [UserController::class, 'verifyOtp']);
Route::post('resetPass', [UserController::class, 'resetPass'])->middleware([TokenVerifyMiddleware::class]);
Route::post('logout', [UserController::class, 'logout'])->middleware([TokenVerifyMiddleware::class]);