<?php

namespace App\Repositories;

use App\Models\PropertyMedia;
use App\Repositories\Contracts\PropertyMediasRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class PropertyMediasRepository implements PropertyMediasRepositoryContract
{
    public function __construct(
        private PropertyMedia $propertyMedias
    )
    {
    }

    public function store(array $data): void
    {
        $this->propertyMedias->create($data);
    }

    public function index(): Collection
    {
        return $this->propertyMedias
            ->get();
    }
}
