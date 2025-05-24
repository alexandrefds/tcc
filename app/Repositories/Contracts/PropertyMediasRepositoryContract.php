<?php

namespace App\Repositories\Contracts;

use App\Models\PropertyMedia;
use Illuminate\Database\Eloquent\Collection;

interface PropertyMediasRepositoryContract
{
    public function store(array $data): void;

    public function index(): Collection;

    public function getById(int $propertyId): PropertyMedia;
}
