<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\StaffHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('StaffHelper', function ($app) {
            return new StaffHelper();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
