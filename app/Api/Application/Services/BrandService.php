<?php

namespace App\Api\Application\Services;

use App\Api\Application\Interfaces\IBrandService;
use App\Api\Application\Requests\BrandRequest\FindBrandRequest;
use App\Api\Application\Requests\BrandRequest\SaveBrandRequest;
use App\Api\Application\Requests\BrandRequest\UpdateBrandRequest;
use App\Api\Domain\BrandAggregate\BrandContracts\IBrandRepository;
use App\Api\Utils\ArchiveTratament\ArchiveTratament;
use App\Api\Utils\ArchiveTratament\ArchiveLocal;
use App\Api\Utils\Guard\Guard;
use Exception;

class BrandService implements IBrandService
{
    private IBrandRepository $brandRepository;
    private ArchiveTratament $archiveTratament;
    private ArchiveLocal $archiveLocal;
    private Guard $guard;

    public function __construct(IBrandRepository $IBrandRepository, ArchiveTratament $ArchiveTratament, ArchiveLocal $ArchiveLocal, Guard $Guard)
    {
        $this->brandRepository = $IBrandRepository;
        $this->archiveTratament = $ArchiveTratament;
        $this->archiveLocal = $ArchiveLocal;
        $this->guard = $Guard;
    }

    public function saveBrand(SaveBrandRequest $request): void
    {
        $this->guard->check(is_numeric($request->input('name')) || preg_match('/[^\w\s]/', $request->input('name')), "O parametro passado não é uma string");
        $filePath = $this->archiveTratament->saveFile($this->archiveLocal, $request->file('image'));

        $brandArray = [
            "nome" => $request->input('name'),
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

    public function findBrand(FindBrandRequest $response): array
    {
        $request = $this->brandRepository->findBrand($response->input('brand_id'));

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

        $brandArray = [
            "id" => $response->input('brand_id'),
            "nome" => $response->input('name'),
        ];

        //recupera objeto refente ao id passado.
        $brand = $this->brandRepository->findBrand($response->input('brand_id'));
        $brand = $brand->getAttributes();

        //remover arquivo
        if (is_file($response->file('image'))) {
            $this->archiveTratament->deleteFile($this->archiveLocal, $brand['imagem']);
            $filePath = $this->archiveTratament->saveFile($this->archiveLocal, $response->file('image'));
            $brandArray["imagem"] = $filePath;
        }

        $this->brandRepository->updateBrand($brandArray);
        return;
    }

    public function deleteBrand(FindBrandRequest $response): void
    {
        $brand = $this->brandRepository->findBrand($response->input('brand_id'));
        $brand = $brand->getAttributes();


        if (!empty($brand['imagem'])) {
            $this->archiveTratament->deleteFile($this->archiveLocal, $brand['imagem']);
        }
        $this->brandRepository->deleteBrand($brand['id']);
    }
}
