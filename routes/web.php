<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Employee\BlogController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin\CouponsController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\Normalization  ;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('welcome');});
Route::get('/about', function () {return view('about');})->name('about');
Route::get('/privacy', function () {return view('privacy');})->name('privacy');
Route::get('/term-and-condition', function () {return view('term-and-condition');})->name('term-and-condition');
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/stores', 'stores')->name('stores');
    Route::middleware(Normalization::class)->group(function () {
    Route::get('/store/{slug}', 'StoreDetails')->name('store_details');
});
    Route::get('/categories', 'categories')->name('categories');
    Route::get('/category/{title}', 'RelatedCategoryStores')->name('related_category');
    // Route for the contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
    Route::get('/coupon', [HomeController::class, 'index'])->name('coupon');
   // Route for search
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::get('/search_results', [SearchController::class, 'searchResults'])->name('search_results');
// Route for blog
    Route::get('/blog', [BlogController::class, 'blog_home'])->name('blog');
    Route::get('/blog/{slug}', [BlogController::class, 'blog_show'])->name('blog-details');
// Route for coupon click
    Route::post('/update-clicks', [CouponsController::class, 'updateClicks'])->name('update.clicks');
    Route::get('/clicks/{couponId}', [CouponsController::class, 'openCoupon'])->name('open.coupon');
});
Route::get('/stores/search', [SearchController::class, 'searchResults'])->name('storesearch');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Admin routes
Route::middleware([RoleMiddleware::class])->group(function () {
      Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');

Route::prefix('employee')->name('employee.')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('dashboard');
});


});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/employee.php';


