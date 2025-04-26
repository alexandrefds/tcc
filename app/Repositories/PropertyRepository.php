<?php

namespace App\Repositories;

use App\Models\Property;
use App\Repositories\Contracts\PropertyRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

readonly class PropertyRepository implements PropertyRepositoryContract
{
    public function __construct(private Property $model)
    {
    }

    public function store(array $data): Property
    {
        return $this->model->create($data);
    }

    public function indexByPropertyIds(array $propertyIds): Collection
    {
        return $this->model
            ->whereIn('id', $propertyIds)
            ->get();
    }
}
