<?php

namespace App\Providers;

use App\Repositories\Contracts\LocationRepositoryContract;
use App\Repositories\LocationRepository;
use Illuminate\Support\ServiceProvider;

class LocationRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            LocationRepositoryContract::class,
            LocationRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
            LocationRepositoryContract::class
        ];
    }
}
