<?php

namespace App\Api\Domain\ModelAggregate\ModelContracts;

use App\Api\Domain\ModelAggregate\Model;

interface IModelRepository {
    public function saveModel(Model $model): void;
    public function findModel();
    public function updateModel();
    public function deleteModel();
    public function findAllModels();
}