<?php

namespace App\Api\Application\Services;

use App\Api\Application\Interfaces\IBrandService;
use App\Api\Application\Requests\BrandRequest\FindBrandRequest;
use App\Api\Application\Requests\BrandRequest\SaveBrandRequest;
use App\Api\Application\Requests\BrandRequest\UpdateBrandRequest;
use App\Api\Domain\BrandAggregate\Brand;
use App\Api\Domain\BrandAggregate\BrandContracts\IBrandRepository;
use App\Api\Utils\ArchiveTratament\ArchiveContracts\ArchivePath;
use App\Api\Utils\ArchiveTratament\ArchiveTratament;
use App\Api\Utils\ArchiveTratament\ArchiveLocal;
use App\Api\Utils\Guard\Guard;
use Illuminate\Support\Collection;

class BrandService implements IBrandService
{
    private IBrandRepository $brandRepository;
    private ArchiveTratament $archiveTratament;
    private Guard $guard;

    public function __construct(IBrandRepository $IBrandRepository, ArchiveTratament $ArchiveTratament, Guard $Guard)
    {
        $this->brandRepository = $IBrandRepository;
        $this->archiveTratament = $ArchiveTratament;
        $this->guard = $Guard;
    }

    public function saveBrand(SaveBrandRequest $request): void
    {
        $this->guard->check(is_numeric($request->input('nome')), "O parametro passado não é uma string");
        $this->guard->check(preg_match('/[^\w\s]/', $request->input('nome')), "Existem caracteres proibidos no nome");

        $filePath = $this->archiveTratament->saveFile(new ArchiveLocal(), $request->file('imagem'), ArchivePath::brands);
        $brand = new Brand(
            $request->input('nome'),
            $filePath
        );
        $this->brandRepository->saveBrand($brand);
    }

    public function findAllBrands(): Collection
    {
        return $this->brandRepository->findAllBrands();
    }

    public function findBrand(FindBrandRequest $response): Brand
    {
       return $this->brandRepository->findBrand($response->input('id')); 
    }

    public function updateBrand(UpdateBrandRequest $request): void
    {
        $this->guard->check(is_numeric($request->input('nome')), "O parametro passado não é uma string");
        $this->guard->check(preg_match('/[^\w\s]/', $request->input('name')), "Existem caracteres proibidos no nome");

        $brand = $this->brandRepository->findBrand($request->input('id'));
        $brand->nome = $request->input('nome');

        if (!empty($request->file('imagem'))) {
            $this->archiveTratament->deleteFile(new ArchiveLocal(), $brand->imagem);
            $filePath = $this->archiveTratament->saveFile(new ArchiveLocal(), $request->file('imagem'), ArchivePath::brands);
            $brand->imagem = $filePath;
        }
        $this->brandRepository->updateBrand($brand);
    }

    public function deleteBrand(FindBrandRequest $response): void
    {
        $brand = $this->brandRepository->findBrand($response->input('id'));

        $this->archiveTratament->deleteFile(new ArchiveLocal(), $brand->imagem);
        $brand->imagem = "removido";
        $this->brandRepository->deleteBrand($brand);
    }
}
