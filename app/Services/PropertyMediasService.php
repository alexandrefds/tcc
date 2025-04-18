<?php

namespace App\Services;

use App\Repositories\Contracts\PropertyMediasRepositoryContract;
use App\Services\Contracts\PropertyMediasServiceContract;

class PropertyMediasService implements PropertyMediasServiceContract
{
    public function __construct(
        private PropertyMediasRepositoryContract $propertyMediasRepository
    )
    {
    }

    public function createPropertyMedias(array $data): void
    {
        $this->propertyMediasRepository->store($data);
    }

    public function getAllPropertyMedias(): array
    {
        return $this->propertyMediasRepository
            ->index()
            ->toArray();
    }
}
