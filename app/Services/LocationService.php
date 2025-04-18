<?php

namespace App\Services;

use App\Repositories\Contracts\LocationRepositoryContract;
use App\Services\Contracts\LocationServiceContract;

class LocationService implements LocationServiceContract
{
    public function __construct(private LocationRepositoryContract $locationRepository)
    {
    }

    public function createLocation(array $data): void
    {
        $this->locationRepository->store($data);
    }

    public function getLocationByIds(array $ids): array
    {
        return $this->locationRepository
            ->indexIds($ids)
            ->toArray();
    }
}
