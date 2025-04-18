<?php

namespace App\Providers;


use App\Services\Contracts\PropertyMediasServiceContract;
use App\Services\PropertyMediasService;
use Illuminate\Support\ServiceProvider;

class PropertyMediasServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            PropertyMediasServiceContract::class,
            PropertyMediasService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
            PropertyMediasServiceContract::class
        ];
    }
}
