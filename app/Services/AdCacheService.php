<?php

namespace App\Services;

use App\Services\Contracts\AdCacheServiceContract;
use App\Services\Contracts\AdServiceContract;
use Illuminate\Support\Facades\Cache;


class AdCacheService implements AdCacheServiceContract
{
    private const CACHE_TIME_THREE_DAYS = 259200;

    public function __construct(private readonly AdServiceContract $adService)
    {
    }

    public function getAdsFromCache(): array
    {
        $cacheKey = 'ads';
        $cachetTime = self::CACHE_TIME_THREE_DAYS;

        return Cache::store('redis')
            ->remember($cacheKey, $cachetTime, function () {
                return $this->adService->getAllAds();
            });
    }

    public function getAdFromCache(int $propertyId): array
    {
        return $this->adService->getAdByPropertyId($propertyId);
    }

    public function clearAdCache(): void
    {
    }
}
