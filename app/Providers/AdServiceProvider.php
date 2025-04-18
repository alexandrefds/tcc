<?php

namespace App\Providers;

use App\Services\AdService;
use App\Services\Contracts\AdServiceContract;
use Illuminate\Support\ServiceProvider;

class AdServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
          AdServiceContract::class,
          AdService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
          AdServiceContract::class
        ];
    }
}
