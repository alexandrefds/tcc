<?php

namespace App\Repositories\Contracts;

use App\Models\Property;
use Illuminate\Database\Eloquent\Collection;

interface PropertyRepositoryContract
{
    public function store(array $data): Property;
    public function indexByPropertyIds(array $propertyIds): Collection;

    public function getById(int $id): Property;
}
