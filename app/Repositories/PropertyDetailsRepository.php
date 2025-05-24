<?php

namespace App\Repositories;

use App\Models\PropertyDetail;
use App\Repositories\Contracts\PropertyDetailsRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class PropertyDetailsRepository implements PropertyDetailsRepositoryContract
{
    public function __construct(
        private PropertyDetail $model
    )
    {
    }

    public function store(array $data): void
    {
        $this->model->create($data);
    }

    public function indexByPropertyIds(array $propertyIds): Collection
    {
        return $this->model
            ->whereIn('property_id', $propertyIds)
            ->get();
    }

    public function getById(int $propertyId): PropertyDetail
    {
        return $this->model
            ->where('property_id', $propertyId)
            ->first();
    }
}
