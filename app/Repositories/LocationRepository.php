<?php

namespace App\Repositories;

use App\Models\Location;
use App\Repositories\Contracts\LocationRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class LocationRepository implements LocationRepositoryContract
{
    public function __construct(private Location $model)
    {
    }

    public function store(array $data): void
    {
        $this->model->create($data);
    }

    public function indexIds(array $ids): Collection
    {
        return $this->model
            ->whereIn("property_id", $ids)
            ->get();
    }
}
