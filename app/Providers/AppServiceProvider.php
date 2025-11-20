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
        // Cap binding extra; Laravel ja té tots els bindings necessaris
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Cap codi extra necessari per ara
    }
}
