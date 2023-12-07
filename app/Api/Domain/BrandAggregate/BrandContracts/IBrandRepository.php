<?php

namespace App\Api\Domain\BrandAggregate\BrandContracts;


use App\Api\Domain\BrandAggregate\Brand;
use Illuminate\Support\Collection;


interface IBrandRepository
{
    public function saveBrand(Brand $brand): void;
    public function findAllBrands(): Collection;
    public function findBrand(int $brandId): Brand;
    public function updateBrand(Brand $request): void;
    public function deletebrand(Brand $brandId): void;

}
