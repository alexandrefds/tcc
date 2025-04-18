<?php

namespace App\Services;

use App\Services\Contracts\AdServiceContract;
use App\Services\Contracts\LocationServiceContract;
use App\Services\Contracts\PropertyDetailsServiceContract;
use App\Services\Contracts\PropertyMediasServiceContract;
use App\Services\Contracts\PropertyServiceContract;

class AdService implements AdServiceContract
{
    const PROPERTY_FILTER = 'property';

    const LOCATION_FILTER = 'location';

    const PROPERTY_DETAILS = 'details';

    const PROPERTY_MEDIAS = 'medias';

    public function __construct
    (
        private PropertyServiceContract $propertyService,
        private LocationServiceContract $locationService,
        private PropertyDetailsServiceContract $propertyDetailsService,
        private PropertyMediasServiceContract $propertyMediaService
    )
    {
    }

    public function createAd(array $data)
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

    public function getAllAds()
    {
        $medias = $this->propertyMediaService
            ->getAllPropertyMedias();

        $propertiesIds = $this->filterPropertyIdsFromMedias($medias);

        if (empty($propertiesIds)) {
            dd('EMPTY!');
        }

        $details = $this->propertyDetailsService->getPropertyDetailsByIds($propertiesIds);

        $location = $this->locationService->getLocationByIds($propertiesIds);

        $properties = $this->propertyService->getPropertiesByIds($propertiesIds);

        /**
         *
         * mudar para collection
         * usar o collect()->where()
         */
        $this->mountAds(
            $propertiesIds,
            $properties,
            $location,
            $details,
            $medias
        );
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

    private function mountAds(
        array $propertiesIds,
        array $properties,
        array $locations,
        array $details,
        array $medias
    )
    {
        $ads = [
            'properties' => [],
            'locations' => [],
            'details' => [],
            'medias' => [],
        ];

        foreach ($propertiesIds as $propertyId) {

            dd(
                array_filter()
            );

            if (in_array($propertyId, $properties['property_id'])) {
                $ads['properties'] = $properties;
            }

            if (in_array($propertyId, $locations['property_id'])) {
                $ads['properties'] = $properties;
            }

            if (in_array($propertyId, $details['property_id'])) {
                $ads['$details'] = $details;
            }

            if (in_array($propertyId, $medias['property_id'])) {
                $ads['$medias'] = $medias;
            }
        }

        dd($ads);
    }
}
