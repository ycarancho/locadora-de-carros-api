<?php

namespace App\Api\Domain\ModelAggregate\ModelContracts;

use App\Api\Domain\ModelAggregate\Model;
use Illuminate\Support\Collection;

interface IModelRepository {
    public function saveModel(Model $model): void;
    public function findModel(int $modelID): Model;
    public function updateModel(Model $model): void;
    public function deleteModel(Model $model): void;
    public function findAllModels(): Collection;
}