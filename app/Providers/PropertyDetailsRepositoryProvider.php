<?php

namespace App\Providers;

use App\Repositories\Contracts\PropertyDetailsRepositoryContract;
use App\Repositories\PropertyDetailsRepository;
use Illuminate\Support\ServiceProvider;

class PropertyDetailsRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            PropertyDetailsRepositoryContract::class,
            PropertyDetailsRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
            PropertyDetailsRepositoryContract::class
        ];
    }
}
