<?php

namespace App\Repositories;

use App\Models\Location;
use App\Repositories\Contracts\LocationRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

readonly class LocationRepository implements LocationRepositoryContract
{
    public function __construct(private Location $model)
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
}
