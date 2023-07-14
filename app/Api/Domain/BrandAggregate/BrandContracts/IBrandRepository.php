<?php

namespace App\Api\Domain\BrandAggregate\BrandContracts;

use App\Api\Application\Requests\BrandRequest;
use App\Api\Domain\BrandAggregate\Brand;
use Illuminate\Database\Eloquent\Collection;

interface IBrandRepository
{
    public function saveBrand(array $request): void;
    public function findAllBrands(): Collection;
    public function findBrand(int $brandId): Brand;
    public function updateBrand(array $request): void;
    public function deletebrand(int $brandId): void;

}
