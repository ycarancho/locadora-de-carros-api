<?php

namespace App\Api\Application\Interfaces;

use App\Api\Application\Requests\BrandRequest\SaveBrandRequest;
use App\Api\Application\Requests\BrandRequest\UpdateBrandRequest;
interface IBrandService {
    public function saveBrand(SaveBrandRequest $response): void;
    public function findAllBrands(): array;
    public function findBrand(int $brandId): array;
    public function updateBrand(UpdateBrandRequest $response): void;
}