<?php

namespace   App\Services\Contracts;

interface AdServiceContract
{
    public function createAd(array $data);

    public function getAllAds();
}
