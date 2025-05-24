<?php

namespace App\Services\Contracts;

interface LocationServiceContract
{
    public function createLocation(array $data): void;

    public function indexByPropertyIds(array $propertyIds): array;

    public function getLocationByPropertyId(int $propertyId): array;
}
