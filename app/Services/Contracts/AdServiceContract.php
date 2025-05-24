<?php

namespace   App\Services\Contracts;

interface AdServiceContract
{
    public function createAd(array $data): void;

    public function getAllAds(): array;

    public function getAdByPropertyId(int $propertyId): array;
}
