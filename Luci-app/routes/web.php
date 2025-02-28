<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('Auth.register');
Route::get('/login', [AuthController::class, 'displayLogin'])->name('Auth.login');
Route::get('/forgetpassword', [AuthController::class, 'displayForgetPW'])->name('Auth.forgetpw');
Route::get('/create-password',[AuthController::class,'createPassword'])->name('Auth.createpassword');
Route::get('/verify', [AuthController::class, 'displayVerifycode'])->name('verify'); // Updated route name for GET

Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/forgetpassword',[AuthController::class, 'forgetpassword'])->name('forgetpassword');
Route::post('/create-password',[AuthController::class, 'createPassword'])->name('createPassword');
Route::post('/verify', [AuthController::class, 'verifyCode'])->name('verify.code'); // Consistent with POST route
