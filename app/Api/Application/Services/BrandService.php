<?php

namespace App\Api\Application\Services;

use App\Api\Application\Interfaces\IBrandService;
use App\Api\Application\Requests\BrandRequest\FindBrandRequest;
use App\Api\Application\Requests\BrandRequest\SaveBrandRequest;
use App\Api\Application\Requests\BrandRequest\UpdateBrandRequest;
use App\Api\Domain\BrandAggregate\BrandContracts\IBrandRepository;
use App\Api\Utils\ArchiveTratament\ArchiveContracts\ArchivePath;
use App\Api\Utils\ArchiveTratament\ArchiveTratament;
use App\Api\Utils\ArchiveTratament\ArchiveLocal;
use App\Api\Utils\Guard\Guard;

class BrandService implements IBrandService
{
    private IBrandRepository $brandRepository;
    private ArchiveTratament $archiveTratament;
    private Guard $guard;

    public function __construct(IBrandRepository $IBrandRepository, ArchiveTratament $ArchiveTratament, ArchiveLocal $ArchiveLocal, Guard $Guard)
    {
        $this->brandRepository = $IBrandRepository;
        $this->archiveTratament = $ArchiveTratament;
        $this->guard = $Guard;
    }

    public function saveBrand(SaveBrandRequest $request): void
    {
        $this->guard->check(is_numeric($request->input('name')), "O parametro passado não é uma string");
        $this->guard->check(preg_match('/[^\w\s]/', $request->input('name')), "Existem caracteres proibidos no nome");

        $filePath = $this->archiveTratament->saveFile(new ArchiveLocal(), $request->file('image'), ArchivePath::brands);
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

    public function updateBrand(UpdateBrandRequest $request): void
    {
        $this->guard->check(is_numeric($request->input('name')), "O parametro passado não é uma string");
        $this->guard->check(preg_match('/[^\w\s]/', $request->input('name')), "Existem caracteres proibidos no nome");

        $brandArray = [
            "id" => $request->input('brand_id'),
            "nome" => $request->input('name'),
        ];

        //recupera objeto refente ao id passado.
        $brand = $this->brandRepository->findBrand($request->input('brand_id'));

        //remover arquivo
        if (!empty($request->file('image'))) {
            $this->archiveTratament->deleteFile(new ArchiveLocal(), $brand->imagem);
            $filePath = $this->archiveTratament->saveFile(new ArchiveLocal(), $request->file('image'), ArchivePath::brands);
            $brandArray["imagem"] = $filePath;
        }

        $this->brandRepository->updateBrand($brandArray);
    }

    public function deleteBrand(FindBrandRequest $response): void
    {
        $brand = $this->brandRepository->findBrand($response->input('brand_id'));

        $this->archiveTratament->deleteFile(new ArchiveLocal(), $brand->imagem);
        $this->brandRepository->deleteBrand($brand['id']);
    }
}
