<?php

namespace App\Api\Infrastructure;

use App\Api\Domain\ModelAggregate\Model;
use App\Api\Domain\ModelAggregate\ModelContracts\IModelRepository;
use Illuminate\Support\Facades\DB;

class ModelRepository implements IModelRepository
{
    public function saveModel(Model $model): void
    {
        DB::transaction(function () use ($model) {
            $model->save();
        });
    }
    public function findModel()
    {
    }
    public function updateModel()
    {
    }
    public function deleteModel()
    {
    }
    public function findAllModels()
    {
    }
}
