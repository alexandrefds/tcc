<?php

namespace App\Services\Contracts;

interface PropertyDetailsServiceContract
{
    public function createPropertyDetails(array $data): void;

    public function indexByPropertyIds(array $propertyIds): array;
}
