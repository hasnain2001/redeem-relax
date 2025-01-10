<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Models\Categories;
use App\Models\Language;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('categories', Categories::all());
            $view->with('langs', Language::all());
            $view->with('currentLang', Session::get('language', 'EN')); 
        });
        $locale = request()->segment(1);
        if (!in_array($locale, ['en', 'es', 'fr', 'ur'])) {
            $locale = 'en'; // Set your default locale
        }
        App::setLocale($locale);
        }
  
}
