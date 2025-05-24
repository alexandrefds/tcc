<?php

namespace App\Services;

use App\Repositories\Contracts\PropertyRepositoryContract;
use App\Services\Contracts\PropertyServiceContract;

readonly class PropertyService implements PropertyServiceContract
{
    public function __construct(private PropertyRepositoryContract $propertyRepository)
    {
    }

    public function createProperty(array $data): array
    {
        $data['created_by'] = 1;

        return $this->propertyRepository
            ->store($data)
            ->toArray();
    }
    public function indexByPropertyIds(array $propertyIds): array
    {
        return $this->propertyRepository
            ->indexByPropertyIds($propertyIds)
            ->toArray();
    }

    public function getPropertyById(int $id): array
    {
        return $this->propertyRepository
            ->getById($id)
            ->toArray();
    }
}
