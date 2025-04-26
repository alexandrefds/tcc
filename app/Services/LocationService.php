<?php

namespace App\Services;

use App\Repositories\Contracts\LocationRepositoryContract;
use App\Services\Contracts\LocationServiceContract;

readonly class LocationService implements LocationServiceContract
{
    public function __construct(private LocationRepositoryContract $locationRepository)
    {
    }

    public function createLocation(array $data): void
    {
        $this->locationRepository->store($data);
    }

    public function indexByPropertyIds(array $propertyIds): array
    {
        return $this->locationRepository
            ->indexByPropertyIds($propertyIds)
            ->toArray();
    }
}
