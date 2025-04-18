<?php

namespace App\Providers;

use App\Repositories\PropertyRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\PropertyRepositoryContract;

class PropertyRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
        PropertyRepositoryContract::class,
        PropertyRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
            PropertyRepositoryContract::class
        ];
    }
}
