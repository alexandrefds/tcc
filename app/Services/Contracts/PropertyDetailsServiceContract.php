<?php

namespace App\Services\Contracts;

interface PropertyDetailsServiceContract
{
    public function createPropertyDetails(array $data): void;

    public function getPropertyDetailsByIds(array $ids): array;
}
