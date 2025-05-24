<?php

namespace App\Repositories;

use App\Models\PropertyMedia;
use App\Repositories\Contracts\PropertyMediasRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class PropertyMediasRepository implements PropertyMediasRepositoryContract
{
    public function __construct(
        private PropertyMedia $model
    )
    {
    }

    public function store(array $data): void
    {
        $this->model->create($data);
    }

    public function index(): Collection
    {
        return $this->model
            ->get();
    }

    public function getById(int $propertyId): PropertyMedia
    {
        return $this->model
            ->where('property_id', $propertyId)
            ->first();
    }
}
