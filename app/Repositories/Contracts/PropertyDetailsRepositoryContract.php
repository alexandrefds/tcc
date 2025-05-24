<?php

namespace App\Repositories\Contracts;

use App\Models\PropertyDetail;
use Illuminate\Database\Eloquent\Collection;

interface PropertyDetailsRepositoryContract
{
    public function store(array $data): void;

    public function indexByPropertyIds(array $propertyIds): Collection;

    public function getById(int $propertyId): PropertyDetail;
}
