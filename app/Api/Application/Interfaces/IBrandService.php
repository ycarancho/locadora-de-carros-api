<?php

namespace App\Api\Application\Interfaces;

use App\Api\Application\Requests\BrandRequest\SaveBrandRequest;
use App\Api\Application\Requests\BrandRequest\UpdateBrandRequest;
use App\Api\Application\Requests\BrandRequest\FindBrandRequest;
interface IBrandService {
    public function saveBrand(SaveBrandRequest $response): void;
    public function findAllBrands(): array;
    public function findBrand(FindBrandRequest $response): array;
    public function updateBrand(UpdateBrandRequest $response): void;
    public function deleteBrand(FindBrandRequest $response): void;
}