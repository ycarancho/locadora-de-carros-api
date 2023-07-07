<?php

namespace App\Api\Application\Services;

use App\Api\Application\Interfaces\IBrandService;
use App\Api\Application\Requests\BrandRequest;
use App\Api\Domain\BrandAggregate\BrandContracts\IBrandRepository;
use App\Api\Utils\ArchiveTratament\SaveArchive;
use App\Api\Utils\ArchiveTratament\SaveArchiveLocal;
use Exception;

class BrandService implements IBrandService
{
    private IBrandRepository $brandRepository;
    private SaveArchive $saveArchive;
    private SaveArchiveLocal $saveArchiveLocal;

    public function __construct(IBrandRepository $IBrandRepository, SaveArchive $SaveArchive, SaveArchiveLocal $SaveArchiveLocal)
    {
        $this->brandRepository = $IBrandRepository;
        $this->saveArchive = $SaveArchive;
        $this->saveArchiveLocal = $SaveArchiveLocal;
    }

    public function saveBrand(BrandRequest $response): void
    {
        if (is_numeric($response->input('name')) || preg_match('/[^\w\s]/', $response->input('name'))) {
            throw new Exception("O parametro passado não é uma string");
        }
        if (!is_file($response->file('image'))) {
            throw new Exception("O parametro passado não é um arquivo");
        }
        $filePath = $this->saveArchive->saveFile($this->saveArchiveLocal, $response->file('image'));

        $brandArray = [
            "nome" => $response->input('name'),
            "imagem" => $filePath
        ];
        $this->brandRepository->saveBrand($brandArray);
    }
}
