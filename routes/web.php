<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Employee\BlogController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin\CouponsController;
use App\Http\Controllers\admin\StoresController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\Normalization;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SitemapController;

// Admin routes
Route::middleware([RoleMiddleware::class])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::prefix('employee')->name('employee.')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('dashboard');
    });
    });
    Route::post('/stores/check-slug',[StoresController::class, 'checkSlug'] )->name('stores.check.slug');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/generate-sitemap', [SitemapController::class, 'generate']);

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/employee.php';
require __DIR__.'/home.php';
require __DIR__.'/migration.php';


