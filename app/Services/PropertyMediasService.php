<?php

namespace App\Services;

use App\Repositories\Contracts\PropertyMediasRepositoryContract;
use App\Services\Contracts\PropertyMediasServiceContract;

readonly class PropertyMediasService implements PropertyMediasServiceContract
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

    public function indexPropertyMedias(): array
    {
        return $this->propertyMediasRepository
            ->index()
            ->toArray();
    }
}
