<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface PropertyMediasRepositoryContract
{
    public function store(array $data): void;

    public function index(): Collection;
}
