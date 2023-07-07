<?php

namespace App\Api\Infrastructure;

use App\Api\Application\Requests\BrandRequest;
use App\Api\Domain\BrandAggregate\BrandContracts\IBrandRepository;
use App\Api\Domain\BrandAggregate\Brand;

class BrandRepository implements IBrandRepository
{
    public function saveBrand(array $request)
    {
        Brand::create($request);
    }
}
