<?php

namespace App\Api\Application\Interfaces;

use App\Api\Application\Requests\ModelsRequest\FindModelRequest;
use App\Api\Application\Requests\ModelsRequest\saveModelRequest;
use App\Api\Domain\ModelAggregate\Model;
use Illuminate\Support\Collection;

interface IModelService
{
    public function saveModel(saveModelRequest $request): void;
    public function findModel(FindModelRequest $request): Model;
    public function updateModel();
    public function deleteModel();
    public function findAllModels(): Collection;
}
