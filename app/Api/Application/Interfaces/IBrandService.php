<?php

namespace App\Api\Application\Interfaces;

use App\Api\Application\Requests\BrandRequest;
interface IBrandService {
    public function saveBrand(BrandRequest $response): void;
}