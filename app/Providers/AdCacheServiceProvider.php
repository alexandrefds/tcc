<?php

namespace App\Providers;

use App\Services\AdCacheService;
use App\Services\Contracts\AdCacheServiceContract;
use Illuminate\Support\ServiceProvider;

class AdCacheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            AdCacheServiceContract::class,
            AdCacheService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
            AdCacheServiceContract::class
        ];
    }
}
