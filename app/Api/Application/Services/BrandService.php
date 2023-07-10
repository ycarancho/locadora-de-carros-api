<?php

namespace App\Api\Application\Services;

use App\Api\Application\Interfaces\IBrandService;
use App\Api\Application\Requests\BrandRequest\SaveBrandRequest;
use App\Api\Application\Requests\BrandRequest\UpdateBrandRequest;
use App\Api\Domain\BrandAggregate\BrandContracts\IBrandRepository;
use App\Api\Utils\ArchiveTratament\ArchiveTratament;
use App\Api\Utils\ArchiveTratament\ArchiveLocal;
use Exception;

class BrandService implements IBrandService
{
    private IBrandRepository $brandRepository;
    private ArchiveTratament $archiveTratament;
    private ArchiveLocal $archiveLocal;

    public function __construct(IBrandRepository $IBrandRepository, ArchiveTratament $ArchiveTratament, ArchiveLocal $ArchiveLocal)
    {
        $this->brandRepository = $IBrandRepository;
        $this->archiveTratament = $ArchiveTratament;
        $this->archiveLocal = $ArchiveLocal;
    }

    public function saveBrand(SaveBrandRequest $response): void
    {
        if (is_numeric($response->input('name')) || preg_match('/[^\w\s]/', $response->input('name'))) {
            throw new Exception("O parametro passado não é uma string");
        }
        $filePath = $this->archiveTratament->saveFile($this->archiveLocal, $response->file('image'));

        $brandArray = [
            "nome" => $response->input('name'),
            "imagem" => $filePath
        ];
        $this->brandRepository->saveBrand($brandArray);
    }

    public function findAllBrands(): array
    {
        $request = $this->brandRepository->findAllBrands();
        $brandArray = [
            "brands" => $request
        ];

        return $brandArray;
    }

    public function findBrand(int $brandId): array
    {
        $request = $this->brandRepository->findBrand($brandId);

        $brandArray = [
            "brand" => $request->getAttributes()
        ];

        return $brandArray;
    }

    public function updateBrand(UpdateBrandRequest $response): void
    {
        if (is_numeric($response->input('name')) || preg_match('/[^\w\s]/', $response->input('name'))) {
            throw new Exception("O parametro passado não é uma string");
        }

        //recupera objeto refente ao id passado.
        $brand = $this->brandRepository->findBrand($response->input('brand_id'));
        $brand = $brand->getAttributes();

        //remover arquivo

        if ($this->archiveTratament->deleteFile($this->archiveLocal, $brand['imagem'])) {
            $filePath = $this->archiveTratament->saveFile($this->archiveLocal, $response->file('image'));
            $brandArray = [
                "id" => $response->input('brand_id'),
                "nome" => $response->input('name'),
                "imagem" => $filePath
            ];
            $this->brandRepository->updateBrand($brandArray);
        }
    }
}
