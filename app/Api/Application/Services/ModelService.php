<?php

namespace App\Api\Application\Services;

use App\Api\Application\Interfaces\IModelService;
use app\Api\Application\Requests\ModelsRequest\FindModelRequest;
use App\Api\Application\Requests\ModelsRequest\saveModelRequest;
use App\Api\Domain\ModelAggregate\ModelContracts\IModelRepository;
use App\Api\Utils\Guard\Guard;
use App\Api\Domain\ModelAggregate\Model;
use App\Api\Utils\ArchiveTratament\ArchiveContracts\ArchivePath;
use App\Api\Utils\ArchiveTratament\ArchiveLocal;
use App\Api\Utils\ArchiveTratament\ArchiveTratament;
use Illuminate\Support\Collection;

class ModelService implements IModelService
{
    private IModelRepository $modelRepository;
    private Guard $guard;
    private ArchiveTratament $archiveTratment;


    public function __construct(IModelRepository $ModelRepository, Guard $Guard, ArchiveTratament $ArchiveTratament)
    {
        $this->modelRepository = $ModelRepository;
        $this->guard = $Guard;
        $this->archiveTratment = $ArchiveTratament;
    }

    public function saveModel(saveModelRequest $request): void
    {
        $this->guard->check(is_numeric($request->input('name')), "O parametro passado não é uma string");
        $this->guard->check(preg_match('/[^\w\s]/', $request->input('name')), "Existem caracteres proibidos no nome");

        $filePath = $this->archiveTratment->saveFile(new ArchiveLocal(), $request->file('image'), ArchivePath::models);

        $model = new Model(
            intval($request->input('brand_id')),
            $request->input('name'),
            $filePath,
            intval($request->input('doors_numbers')),
            intval($request->input('places')),
            intval($request->input('air_bag')),
            intval($request->input('abs')),
        );

        $this->modelRepository->saveModel($model);
    }
    public function findModel(FindModelRequest $request): Model
    {
        return $this->modelRepository->findModel($request->input('model_id'));
    }
    public function updateModel()
    {
    }
    public function deleteModel()
    {
    }
    public function findAllModels(): Collection
    {
        return $this->modelRepository->findAllModels();
    }
}
