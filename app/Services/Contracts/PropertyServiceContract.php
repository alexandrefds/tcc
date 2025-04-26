<?php

namespace App\Services\Contracts;

interface PropertyServiceContract
{
    public function createProperty(array $data): array;
    public function indexByPropertyIds(array $propertyIds): array;
}
