<?php
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', function () {
    return view('home');
});

// Authentication Routes
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogle']);

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

// Logout Route
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes for Users
Route::middleware(['auth:web'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});

// Protected Routes for Admins
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
