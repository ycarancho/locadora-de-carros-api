<?php

namespace App\Api\Infrastructure;

use App\Api\Domain\BrandAggregate\BrandContracts\IBrandRepository;
use App\Api\Domain\BrandAggregate\Brand;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BrandRepository implements IBrandRepository
{
    private Brand $brand;

    public function __construct(Brand $Brand)
    {
        $this->brand = $Brand;
    }


    public function saveBrand(Brand $brand): void
    {
        DB::transaction(function () use ($brand) {
            $brand->save();
        });
    }

    public function findAllBrands(): Collection
    {
        return $this->brand->all()->whereNull('deleted_at')->map(function ($item) {
            return [
                'nome' => $item->nome,
                'imagem' => $item->imagem,
                'id' => $item->id
            ];
        });
    }

    public function findBrand(int $brandId): Brand
    {
        return $this->brand->where('id', $brandId)->first();
    }

    public function updateBrand(Brand $brand): void
    {
        DB::transaction(function () use ($brand) {
            if(!empty($brand->deleted_at)){
                $brand->restore();
            }

            $brand->updated_at = now('America/Sao_Paulo');
            $brand->update();
        });
    }

    public function deletebrand(Brand $brand): void
    {
        DB::transaction(function () use ($brand) {
            $brand->update();
            $brand->delete();
        });
    }
}
