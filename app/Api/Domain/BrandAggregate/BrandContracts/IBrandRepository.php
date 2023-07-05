<?php

namespace App\Api\Domain\BrandAggregate\BrandContracts;
use App\Api\Application\Requests\BrandRequest;
use App\Api\Domain\BrandAggregate\Brand;
interface IBrandRepository {
    public function saveBrand(array $request);
}