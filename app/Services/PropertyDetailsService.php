<?php

namespace App\Services;

use App\Repositories\Contracts\PropertyDetailsRepositoryContract;
use App\Services\Contracts\PropertyDetailsServiceContract;

class PropertyDetailsService implements PropertyDetailsServiceContract
{
    public function __construct(private PropertyDetailsRepositoryContract $propertyDetailsRepository)
    {
    }

    public function createPropertyDetails(array $data): void
    {
        $this->propertyDetailsRepository->store($data);
    }

    public function getPropertyDetailsByIds(array $ids): array
    {
        return $this->propertyDetailsRepository
            ->indexByIds($ids)
            ->toArray();
    }
}
