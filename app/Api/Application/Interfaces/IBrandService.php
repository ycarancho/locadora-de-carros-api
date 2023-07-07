<?php

namespace App\Api\Application\Interfaces;

use App\Api\Application\Requests\BrandRequest\SaveBrandRequest;
interface IBrandService {
    public function saveBrand(SaveBrandRequest $response): void;
    public function findAllBrands(): array;
    public function findBrand(int $brandId): array;
}