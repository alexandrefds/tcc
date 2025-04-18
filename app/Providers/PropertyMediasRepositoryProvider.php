<?php

namespace App\Providers;

use App\Repositories\Contracts\PropertyMediasRepositoryContract;
use App\Repositories\PropertyMediasRepository;
use Illuminate\Support\ServiceProvider;

class PropertyMediasRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
          PropertyMediasRepositoryContract::class,
          PropertyMediasRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): array
    {
        return [
            PropertyMediasRepositoryContract::class
        ];
    }
}
