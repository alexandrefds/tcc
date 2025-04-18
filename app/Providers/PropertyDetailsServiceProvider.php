<?php

namespace App\Providers;

use App\Services\Contracts\PropertyDetailsServiceContract;
use App\Services\PropertyDetailsService;
use Illuminate\Support\ServiceProvider;

class PropertyDetailsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            PropertyDetailsServiceContract::class,
            PropertyDetailsService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
            PropertyDetailsServiceContract::class
        ];
    }
}
