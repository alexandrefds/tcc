<?php

namespace App\Services;

use App\Repositories\Contracts\PropertyDetailsRepositoryContract;
use App\Services\Contracts\PropertyDetailsServiceContract;

readonly class PropertyDetailsService implements PropertyDetailsServiceContract
{
    public function __construct(private PropertyDetailsRepositoryContract $propertyDetailsRepository)
    {
    }

    public function createPropertyDetails(array $data): void
    {
        $this->propertyDetailsRepository->store($data);
    }

    public function indexByPropertyIds(array $propertyIds): array
    {
        return $this->propertyDetailsRepository
            ->indexByPropertyIds($propertyIds)
            ->toArray();
    }

    public function getPropertyDetailsByPropertyId(int $propertyId): array
    {
        return $this->propertyDetailsRepository
            ->getById($propertyId)
            ->toArray();
    }
}
