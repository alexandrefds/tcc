<?php

namespace App\Providers;

use App\Services\Contracts\LocationServiceContract;
use App\Services\LocationService;
use Illuminate\Support\ServiceProvider;

class LocationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            LocationServiceContract::class,
            LocationService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
            LocationServiceContract::class
        ];
    }
}
