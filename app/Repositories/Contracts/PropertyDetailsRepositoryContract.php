<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface PropertyDetailsRepositoryContract
{
    public function store(array $data): void;

    public function indexByPropertyIds(array $propertyIds): Collection;
}
