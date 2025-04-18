<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface LocationRepositoryContract
{
    public function store(array $data): void;

    public function indexIds(array $ids): Collection;
}
