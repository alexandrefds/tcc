<?php

namespace App\Services;

use App\Services\Contracts\AdServiceContract;
use App\Services\Contracts\LocationServiceContract;
use App\Services\Contracts\PropertyDetailsServiceContract;
use App\Services\Contracts\PropertyMediasServiceContract;
use App\Services\Contracts\PropertyServiceContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class AdService implements AdServiceContract
{
    const PROPERTY_FILTER = 'property';

    const LOCATION_FILTER = 'location';

    const PROPERTY_DETAILS = 'details';

    const PROPERTY_MEDIAS = 'medias';

    public function __construct
    (
        private readonly PropertyServiceContract        $propertyService,
        private readonly LocationServiceContract        $locationService,
        private readonly PropertyDetailsServiceContract $propertyDetailsService,
        private readonly PropertyMediasServiceContract $propertyMediaService
    )
    {
    }

    public function createAd(array $data): void
    {
        $property = $this->getFilterDate($data, self::PROPERTY_FILTER);
        $propertyCreated = $this->propertyService->createProperty($property);

        $location = $this->getFilterDate($data, self::LOCATION_FILTER);
        $location['property_id'] = $propertyCreated['id'];
        $this->locationService->createLocation($location);

        $details = $this->getFilterDate($data, self::PROPERTY_DETAILS);
        $details['property_id'] = $propertyCreated['id'];
        $this->propertyDetailsService->createPropertyDetails($details);

        $medias = $this->getFilterDate($data, self::PROPERTY_MEDIAS);
        $medias['property_id'] = $propertyCreated['id'];
        $this->propertyMediaService->createPropertyMedias($medias);
    }

    public function getAdsFromCache(): array
    {
        $cacheKey = 'ads';
        $cachetTime = 1440;

        return Cache::store('redis')
            ->remember($cacheKey, $cachetTime, function () {
                return $this->getAllAds();
            });
    }

    private function getAllAds(): array
    {
        $medias = $this->propertyMediaService->indexPropertyMedias();

        $adsCreatedIds = $this->filterPropertyIdsFromMedias($medias);

        $properties = $this->propertyService->indexByPropertyIds($adsCreatedIds);

        $locations = $this->locationService->indexByPropertyIds($adsCreatedIds);

        $details = $this->propertyDetailsService->indexByPropertyIds($adsCreatedIds);

        return $this->mountAds($adsCreatedIds, $properties, $locations, $details, $medias);
    }

    private function mountAds(
        array $adsCreatedIds,
        array $properties,
        array $locations,
        array $details,
        array $medias
    ): array
    {
        $ads = [];

        foreach ($adsCreatedIds as $adCreatedId) {
            $ads[] = [
                'property' => $this->getPropertyById($adCreatedId, $properties),
                'location' => $this->getLocationById($adCreatedId, $locations), //inserir a busca por cidade
                'details' => $this->getDetailsById($adCreatedId, $details),
                'medias' => $this->getMediasById($adCreatedId, $medias),
            ];
        }

        return $ads;
    }

    private function getFilterDate(array $data, string $filter): array
    {
        $filterDate = [];

        if (isset($data[$filter]) &&
            is_array($data[$filter])
        ) {
            $filterDate = $data[$filter];
        }

        return $filterDate;
    }

    private function filterPropertyIdsFromMedias(array $medias): array
    {
        $propertiesIds = [];

        foreach ($medias as $media) {
            $propertiesIds[] = $media['property_id'];
        }

        return $propertiesIds;
    }

    private function getPropertyById(int $propertyId, array $properties): array
    {
        foreach ($properties as $property) {
            if ($property['id'] == $propertyId) {
                return $property;
            }
        }

        return [];
    }

    private function getLocationById(int $propertyId, array $locations): array
    {
        foreach ($locations as $location) {
            if ($location['property_id'] == $propertyId) {
                return $location;
            }
        }

        return [];
    }

    private function getDetailsById(int $propertyId, array $details): array
    {
        foreach ($details as $detail) {
            if ($detail['property_id'] == $propertyId) {
                return $detail;
            }
        }

        return [];
    }

    private function getMediasById(int $propertyId, array $medias): array
    {
        foreach ($medias as $media) {

            if ($media['property_id'] == $propertyId) {
                return $media;
            }
        }

        return [];
    }
}
