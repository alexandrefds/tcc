<?php

namespace App\Services\Contracts;

interface PropertyMediasServiceContract
{
    public function createPropertyMedias(array $data): void;

    public function indexPropertyMedias(): array;
}
