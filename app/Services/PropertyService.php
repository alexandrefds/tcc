<?php

namespace App\Services;

use App\Repositories\Contracts\PropertyRepositoryContract;
use App\Services\Contracts\PropertyServiceContract;

class PropertyService implements PropertyServiceContract
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

    public function getPropertiesByIds(array $ids): array
    {
        return $this->propertyRepository
            ->indexByIds($ids)
            ->toArray();
    }
}
