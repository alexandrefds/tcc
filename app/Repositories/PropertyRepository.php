<?php

namespace App\Repositories;

use App\Models\Property;
use App\Repositories\Contracts\PropertyRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class PropertyRepository implements PropertyRepositoryContract
{
    public function __construct(private Property $model)
    {
    }

    public function store(array $data): Property
    {
        return $this->model->create($data);
    }

    public function indexByIds(array $ids): Collection
    {
        return $this->model
            ->whereIn('id', $ids)
            ->get();
    }
}
