<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\MailServiceInterface;
use App\Services\MailService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(MailServiceInterface::class, MailService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
