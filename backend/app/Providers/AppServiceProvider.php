<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('role', function () {
            return new Role();
        });
    }
    
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind('role', function () {
            return new Role();
        });
    }
}
