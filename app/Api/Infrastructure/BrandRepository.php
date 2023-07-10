<?php

namespace App\Api\Infrastructure;

use App\Api\Application\Requests\BrandRequest;
use App\Api\Domain\BrandAggregate\BrandContracts\IBrandRepository;
use App\Api\Domain\BrandAggregate\Brand;
use Illuminate\Database\Eloquent\Collection;

class BrandRepository implements IBrandRepository
{
    private Brand $brand;

    public function __construct(Brand $Brand)
    {
        $this->brand = $Brand;
    }


    public function saveBrand(array $request)
    {
        $this->brand->create($request);
    }

    public function findAllBrands(): Collection
    {
        $brands = $this->brand->all();

        if (!$brands) {
            return new Brand();
        }

        return $brands;
    }

    public function findBrand(int $brandId): Brand
    {
        $brand = $this->brand->where('id', $brandId)->first();
        if (!$brand) {
            return new Brand();
        }

        return $brand;
    }

    public function updateBrand(array $request)
    {

        $this->brand->where('id', $request['id'])->update(['nome'=> $request['nome'], 'imagem'=> $request['imagem']]);
    }
}
