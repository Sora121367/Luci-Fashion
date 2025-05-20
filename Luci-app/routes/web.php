<?php
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\User\UserProductController;
// Home Page
// Route::get('/', function () {
//     return view('home');
// });

// Authentication Routes
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogle']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('Auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
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
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');





// User Route
Route::get('/', [UserProductController::class, 'index']);


Route::get('/show-product/{id}',[UserProductController::class,'show']);

Route::get('/men-products',function(){
    $products =[
        ["src"=>"product-images/men-clothing.jpg","price"=>"$19.99","info"=>"Gangstar Outfit","id" => "1"],
        ["src"=>"product-images/men-pants.jpg","price"=>"$20.59","info"=>"Casual Round Neck","id" => "2"],
        ["src"=>"product-images/men-shirts.jpg","price"=>"$25.42","info"=>"Bside with a gang","id" => "3"],
        ["src" => "product-images/product-1.jpg", "price" => "$19.99", "info" => "Gangstar Outfit", "id" => "4"],
    ];
    return view('User.men-products',["products"=>$products]);
});

Route::get('/women-products',function(){
    $products =[
        ["src"=>"product-images/women-1.jpg","price"=>"$19.99","info"=>"Gangstar Outfit","id" => "1"],
        ["src"=>"product-images/women-2.jpg","price"=>"$20.59","info"=>"Casual Round Neck","id" => "2"],
        ["src"=>"product-images/women-3.jpg","price"=>"$25.42","info"=>"Bside with a gang","id" => "3"],
    ];
    return view('User.women-products',["products"=>$products]);
});

Route::get('/user-favorite',function(){
    $products =[
        ["src"=>"product-images/product-1.jpg","price"=>"$19.99","info"=>"Gangstar Outfit","id" => "1"],
        ["src"=>"product-images/product-2.jpg","price"=>"$20.59","info"=>"Casual Round Neck","id" => "2"],
        ["src"=>"product-images/product-3.jpg","price"=>"$25.42","info"=>"Bside with a gang","id" => "3"],
    ];
    return view('User.user-favorite',["products"=>$products]);
});

Route::get('/checkout',function(){
    $products =[
        ["src"=>"product-images/product-1.jpg","price"=>"$19.99","info"=>"Gangstar Outfit","id" => "1"],
        ["src"=>"product-images/product-2.jpg","price"=>"$20.59","info"=>"Casual Round Neck","id" => "2"],
        ["src"=>"product-images/product-3.jpg","price"=>"$25.42","info"=>"Bside with a gang","id" => "3"],
    ];
    return view('User.checkout',["products"=>$products]);
});

//admin
// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// });
// Route::get('/customers', function () {
//     return view('admin.customers');
// });
// Route::get('/categories', function () {
//     return view('admin.categories');
// });
// Route::get('/report', function () {
//     return view('admin.report');
// });
// Route::get('/sales', function () {
//     return view('admin.sales');
// });
// Route::get('/setting', function () {
//     return view('admin.setting');
// });
// Route::get('/logout', function () {
//     return view('admin.logout');
// });


/*
|--------------------------------------------------------------------------
| User-Protected Routes (auth:web)
|--------------------------------------------------------------------------
*/


Route::middleware(['web'])->group(function () {
  
    
});



// Admin Protected Routes
Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/customers', function () {
        return view('admin.customers');
    })->name('admin.customers');

    Route::get('/categories', function () {
        return view('admin.categories');
    })->name('admin.categories');

    Route::get('/report', function () {
        return view('admin.report');
    })->name('admin.report');

    Route::get('/sales', function () {
        return view('admin.sales');
    })->name('admin.sales');

    Route::get('/setting', function () {
        return view('admin.setting');
    })->name('admin.setting');

    Route::get('/logout', function () {
        return view('admin.logout');
    })->name('admin.logout');
});


Route::get('/productlist', [ProductController::class, 'index'])->name('admin.productlist');
Route::get('/newproducts', function () {
    return view('admin.newproducts');
});
Route::get('/productlist', [ProductController::class, 'index'])->name('admin.productlist');
Route::post('/saveproduct', [ProductController::class, 'store'])->name('admin.saveproduct');
Route::delete('/productlist/{id}', [ProductController::class, 'destroy'])->name('admin.destroy');