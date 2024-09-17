<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\StaffHelper;
use App\Helpers\UtilityHelper;

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
        $this->app->singleton('UtilityHelper', function ($app) {
            return new UtilityHelper();
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
