<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


// Fresh migrations
Route::get('/migrate-fresh', function () {
    $exitCode = Artisan::call('migrate:fresh');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

// Run migrations without refreshing the database
Route::get('/migrate', function () {
    $exitCode = Artisan::call('migrate');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

// Rollback migrations
Route::get('/migrate-rollback', function () {
    $exitCode = Artisan::call('migrate:rollback');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

// Reset migrations
Route::get('/migrate-reset', function () {
    $exitCode = Artisan::call('migrate:reset');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

// Seed the database
Route::get('/db-seed', function () {
    $exitCode = Artisan::call('db:seed');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});

// Run migrations and seed database
Route::get('/migrate-seed', function () {
    $exitCode = Artisan::call('migrate:fresh --seed');
    $output = Artisan::output();
    return "Exit Code: $exitCode <br> Output: <pre>$output</pre>";
});



