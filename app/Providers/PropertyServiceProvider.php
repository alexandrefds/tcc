<?php

namespace App\Providers;

use App\Services\Contracts\PropertyServiceContract;
use App\Services\PropertyService;
use Illuminate\Support\ServiceProvider;

class PropertyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            PropertyServiceContract::class,
            PropertyService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
            PropertyServiceContract::class
        ];
    }
}
