<?php

namespace App\Repositories\Contracts;

use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

interface LocationRepositoryContract
{
    public function store(array $data): void;

    public function indexByPropertyIds(array $propertyIds): Collection;

    public function getById(int $propertyId): Location;
}
