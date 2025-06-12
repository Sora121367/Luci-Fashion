<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FavoriteProductController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\User\UserProductController;
use App\Models\FavoriteProduct;
use App\Http\Controllers\admin\CategoryController;
use App\Models\Category;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\CustomerOrderController;
use App\Http\Controllers\admin\NotificationController;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Notifications\OrderCompleted;
use App\Http\Controllers\admin\ReportController;








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
//Route::get('/forgetpassword', [AuthController::class, 'displayForgetPasswordForm'])->name('Auth.forgetpw');
Route::post('/forgetpassword', [AuthController::class, 'forgetPassword'])->name('forgetpassword.post');

Route::get('/verify-reset-code', [AuthController::class, 'displayVerifyResetCodeForm'])->name('password.verify');
Route::post('/verify-reset-code', [AuthController::class, 'verifyResetCode'])->name('password.verify.post');

Route::get('/create-password', [AuthController::class, 'displayCreatePassword'])->name('Auth.createpassword');
Route::post('/create-password', [AuthController::class, 'createPassword'])->name('createPassword');

Route::get('/verify', [AuthController::class, 'displayVerifycode'])->name('verify.show');
Route::post('/verify', [AuthController::class, 'verifyCode'])->name('verify.code');

// Logout Route



Route::get('/forgetpassword', [AuthController::class, 'displayForgetPW'])
    ->middleware('guest')
    ->name('password.request');





// User Route
Route::get('/', [UserProductController::class, 'index'])->name("home");


//Route::get('/contact-us', [FeedbackController::class, 'index'])->name("contact-us");
Route::post('/report-submit', [FeedbackController::class, 'store'])->name("report-submit");


Route::get('/show-product/{id}', [UserProductController::class, 'show']);

Route::get('/men-products', [UserProductController::class, 'menProducts']);

Route::get('/women-products', [UserProductController::class, 'womenProducts']);

Route::get('/user-favorite', [FavoriteProductController::class, 'index']);

Route::get('/checkout', [CheckoutController::class, 'index']);
Route::get('/view-order-history', [OrderController::class, 'index'])->name("order-history");

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


Route::get('/orders/{id}', function ($id) {
    $order = Order::findOrFail($id); // find the order from DB

    return view('orders.invoice', compact('order')); // return invoice view
});


Route::middleware(['web'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/contact-us', [FeedbackController::class, 'index'])->name("contact-us");
});


//Admin route
Route::middleware(['admin'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/customers', function () {
        return view('admin.customers');
    })->name('admin.customers');

    Route::get('/categorylist', function () {
        return view('admin.categorylist');
    })->name('admin.categorylist');

    Route::get('/report', function () {
        return view('admin.report');
    })->name('admin.report');

    Route::get('/setting', function () {
        return view('admin.setting');
    })->name('admin.setting');

    Route::get('/logout', function () {
        return view('admin.logout');
    })->name('admin.logout');

    Route::get('/productlist', [ProductController::class, 'index'])->name('admin.productlist');
    Route::get('/newproducts', function () {
        return view('admin.newproducts');
    });
    //NewCategory 
    Route::get('/newcategory', function () {
        return view('admin.newcategory');
    })->name('admin.newcategory');
    Route::get('/newcategory', function () {
        // Pass categories to the view so parent options can be selected
        $categories = Category::all();
        return view('admin.newcategory', compact('categories'));
    });
    Route::get('/newproducts', function () {
        // Fetch categories where parent_id is null for main categories and others for subcategories
        $mainCategories = Category::whereNull('parent_id')->get();
        $subCategories = Category::whereNotNull('parent_id')->get();
        return view('admin.newproducts', compact('mainCategories', 'subCategories'));
    });

    Route::get('/categorylist', [CategoryController::class, 'index'])->name('admin.categorylist');
    Route::get('/categories', [CategoryController::class, 'create'])->name('admin.categories');
    Route::get('editcategory/{id}', [CategoryController::class, 'edit']);
    Route::get('editproducts/{id}', [ProductController::class, 'edit']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

});

 Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])
    ->name('notifications.markAllRead')
    ->middleware('auth:admin');

// admin route 

Route::post('savecategory', [CategoryController::class, 'store'])->name('admin.savecategory');
// Route::post('/savecategory', [CategoryController::class, 'store']);
Route::post('updatecategory/{id}', [CategoryController::class, 'update']);
Route::delete('deletecategory/{id}', [CategoryController::class, 'destroy']);
// Route::post('/saveproduct', [ProductController::class, 'store'])->name('admin.saveproduct');
Route::post('/newproducts',[ProductController::class,'store'])->name('admin.saveproduct');
Route::delete('/productlist/{id}', [ProductController::class, 'destroy'])->name('admin.destroy');
Route::post('updateproducts/{id}', [ProductController::class, 'update']);
// Route::get('/feedback-report', [FeedbackController::class, 'showFeedbackReport'])->name('admin.feedback.report');
// Route::delete('feedback/{id}', [FeedbackController::class, 'deleteFeedback'])->name('admin.feedback.delete');
Route::get('/report', [ReportController::class, 'index'])->name('admin.report');
Route::delete('/report/{id}', [ReportController::class, 'destroy'])->name('admin.report.delete');

Route::get('/customers', [CustomerOrderController::class, 'index'])->name('admin.customers');
// API endpoints
Route::get('/api/customers', [CustomerOrderController::class, 'getCustomers']);
Route::get('/api/customers/{userId}/orders', [CustomerOrderController::class, 'getOrdersByUser']);
Route::post('/api/orders/{orderId}/status', [CustomerOrderController::class, 'updateOrderStatus']);

Route::get('/customers/{id}/orders', [CustomerOrderController::class, 'getCustomerOrders']);
Route::post('/orders/{order}/status', [CustomerOrderController::class, 'updateOrderStatus']);
