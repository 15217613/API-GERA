<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Laravel\Passport\Passport;
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
        // Habilitar el grant_type password
        Passport::enablePasswordGrant();

        // Expiracion del token
        Passport::tokensExpireIn(CarbonInterval::days(1));
    }
}
