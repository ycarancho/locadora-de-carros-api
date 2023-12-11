<?php

namespace App\Api\Application\Services;

use App\Api\Application\Interfaces\IModelService;
use app\Api\Application\Requests\ModelsRequest\FindModelRequest;
use App\Api\Application\Requests\ModelsRequest\saveModelRequest;
use App\Api\Application\Requests\ModelsRequest\UpdateModelRequest;
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
        $this->guard->check(is_numeric($request->input('nome')), "O parametro passado não é uma string");
        $this->guard->check(preg_match('/[^\w\s]/', $request->input('nome')), "Existem caracteres proibidos no nome");

        $filePath = $this->archiveTratment->saveFile(new ArchiveLocal(), $request->file('imagem'), ArchivePath::models);

        $model = new Model(
            intval($request->input('marca_id')),
            $request->input('nome'),
            $filePath,
            intval($request->input('numero_portas')),
            intval($request->input('lugares')),
            intval($request->input('air_bag')),
            intval($request->input('abs')),
        );

        $this->modelRepository->saveModel($model);
    }

    public function findModel(FindModelRequest $request): Model
    {
        return $this->modelRepository->findModel($request->input('id'));
    }
    
    public function updateModel(UpdateModelRequest $request): void
    {
        $this->guard->check(is_numeric($request->input('nome')), "O parametro passado não é uma string");
        $this->guard->check(preg_match('/[^\w\s]/', $request->input('nome')), "Existem caracteres proibidos no nome");

        $model = $this->modelRepository->findModel($request->input('id'));

        if (!empty($request->file('imagem'))) {
            $this->archiveTratment->deleteFile(new ArchiveLocal(), $model->imagem);
            $filePath = $this->archiveTratment->saveFile(new ArchiveLocal(), $request->file('imagem'), ArchivePath::models);
            $model->imagem = $filePath;
        }
        foreach ($model->getAttributes() as $key => $value) {
            if ($key != 'imagem' && $key != 'created_at') {
                $model->$key = $request->input($key);
            };
        }
        $this->modelRepository->updateModel($model);
    }

    public function deleteModel(FindModelRequest $request): void
    {
        $model = $this->modelRepository->findModel($request->input('id'));

        if(!empty($model->imagem)){
            $this->archiveTratment->deleteFile(new ArchiveLocal(), $model->imagem);
            $model->imagem = "removido";
        }
        
        $this->modelRepository->deleteModel($model);
    }

    public function findAllModels(): Collection
    {
        return $this->modelRepository->findAllModels();
    }
}
