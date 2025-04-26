<?php

namespace   App\Services\Contracts;

interface AdServiceContract
{
    public function createAd(array $data): void;

    public function getAdsFromCache(): array;
}
