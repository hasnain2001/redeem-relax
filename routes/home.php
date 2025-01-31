<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\Localization;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\admin\CouponsController;
use App\Http\Controllers\HomeController;

Route::middleware([SetLocale::class])->group(function () {
    Route::group(['prefix' => '{locale}',], function () {
        Route::get('/contact', function () {
            return view('contact');
                     })->name('contact');
        Route::get('/about', function () {
            return view('about');
        })->name('about');
    
    
    Route::get('/terms-and-condition', function () {
        return view('terms_and_condition');
    })->name('terms_and_condition');


    Route::get('/privacy', function () {
        return view('privacy');
    })->name('privacy');

    Route::get('/cookies', function () {
        return view('cookies');
    })->name('cookies');
    Route::get('/imprint', function () {
        return view('imprint');
    })->name('imprint');
     });});

 Route::middleware([Localization::class])->group(function () {
    Route::controller(HomeController::class)->group(function () {
 
    Route::get('/{lang?}', 'index')->name('home');
    Route::get('/{lang}/stores', 'stores')->name('store.show');
    Route::get('store/{slug}', function($slug) {return app(HomeController::class)->StoreDetails('en', $slug, request());})->name('store_details');
    Route::get('/{lang}/store/{slug}', [HomeController::class, 'StoreDetails'])->name('store_details.withLang');

    Route::get('/category/{slug}', [HomeController::class, 'viewcategory'])->name('related_category');
    Route::get('/categories', 'categories')->name('categories');
    Route::get('/{lang}/blog', 'blog_home')->name('blog');
    Route::get('/blog/{slug}', 'blog_show')->name('blog-details');
 
    });
    });

    Route::get('coupons', [CouponsController::class, 'index'])->name('coupons.index');
    Route::put('/updateCoupon/{id}', [CouponsController::class, 'update'])->name('updateCoupon');
    Route::post('/update-clicks', [CouponsController::class, 'updateClicks'])->name('update.clicks');
    Route::get('/clicks/{couponId}', [CouponsController::class, 'openCoupon'])->name('open.coupon');
    // Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    // Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
    Route::post('/coupons', [CouponsController::class, ''])->name('coupons.updateRanking');
    Route::get('/stores/search', [SearchController::class, 'search'])->name('search');
    Route::get('/stores/search_results', [SearchController::class, 'searchResults'])->name('search_results');

