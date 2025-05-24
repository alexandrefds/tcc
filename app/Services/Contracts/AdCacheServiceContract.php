<?php

namespace App\Services\Contracts;

interface AdCacheServiceContract
{
    public function getAdsFromCache(): array;

    public function getAdFromCache(int $propertyId): array;

    public function clearAdCache(): void;
}
