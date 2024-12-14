<?php

namespace App\Providers;

use App\Models\Allergen;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer(['recepty.*'], function ($view) {
            $view->with('allergens', Allergen::all(['id', 'name', 'genitive_name']));
        });
    }
}
