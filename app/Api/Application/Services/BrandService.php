<?php

namespace App\Api\Application\Services;

use App\Api\Application\Interfaces\IBrandService;
use App\Api\Application\Requests\BrandRequest;
use App\Api\Domain\BrandAggregate\BrandContracts\IBrandRepository;
use App\Api\Utils\ArchiveTratament\SaveArchiveLocal;
use Exception;

class BrandService implements IBrandService
{
    private IBrandRepository $brandRepository;
    private SaveArchiveLocal $saveArchiveLocal;

    public function __construct(IBrandRepository $IBrandRepository, SaveArchiveLocal $SaveArchiveLocal)
    {
        $this->brandRepository = $IBrandRepository;
        $this->saveArchiveLocal = $SaveArchiveLocal;
    }
    public function saveBrand(BrandRequest $response): void
    {
        if (is_numeric($response->name) || preg_match('/[^\w\s]/', $response->name)) {
            throw new Exception("O parametro passado não é uma string");
        }
        if (!is_file($response->image)) {
            throw new Exception("O parametro passado não é um arquivo");
        }
        $filePath = $this->saveArchiveLocal->save($response->image);

        $brandArray = [
            "nome" => $response->name,
            "imagem" => $filePath
        ];
        dd($brandArray);
        $this->brandRepository->saveBrand($brandArray);
    }
}
