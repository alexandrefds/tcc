<?php

namespace App\Repositories\Contracts;

use App\Models\Property;
use Illuminate\Database\Eloquent\Collection;

interface PropertyRepositoryContract
{
    public function store(array $data): Property;

    public function indexByIds(array $ids): Collection;
}
