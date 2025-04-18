<?php

namespace App\Services\Contracts;

interface LocationServiceContract
{
    public function createLocation(array $data): void;

    public function getLocationByIds(array $ids): array;
}
