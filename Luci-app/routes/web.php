<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('Auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'displayLogin'])->name('Auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/forgetpassword', [AuthController::class, 'displayForgetPasswordForm'])->name('Auth.forgetpw');
Route::post('/forgetpassword', [AuthController::class, 'forgetPassword'])->name('forgetpassword.post');

Route::get('/verify-reset-code', [AuthController::class, 'displayVerifyResetCodeForm'])->name('password.verify');
Route::post('/verify-reset-code', [AuthController::class, 'verifyResetCode'])->name('password.verify.post');

Route::get('/create-password', [AuthController::class, 'displayCreatePassword'])->name('Auth.createpassword');
Route::post('/create-password', [AuthController::class, 'createPassword'])->name('createPassword');

Route::get('/verify', [AuthController::class, 'displayVerifycode'])->name('verify.show');
Route::post('/verify', [AuthController::class, 'verifyCode'])->name('verify.code');
