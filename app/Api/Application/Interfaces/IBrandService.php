<?php

namespace App\Api\Application\Interfaces;

use App\Api\Application\Requests\BrandRequest\SaveBrandRequest;
use App\Api\Application\Requests\BrandRequest\UpdateBrandRequest;
use App\Api\Application\Requests\BrandRequest\FindBrandRequest;
use App\Api\Domain\BrandAggregate\Brand;
use Illuminate\Support\Collection;

interface IBrandService {
    public function saveBrand(SaveBrandRequest $response): void;
    public function findAllBrands(): Collection;
    public function findBrand(FindBrandRequest $response): Brand;
    public function updateBrand(UpdateBrandRequest $response): void;
    public function deleteBrand(FindBrandRequest $response): void;
}