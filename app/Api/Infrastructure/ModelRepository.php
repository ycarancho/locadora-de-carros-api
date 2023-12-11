<?php

namespace App\Api\Infrastructure;

use App\Api\Domain\ModelAggregate\Model;
use App\Api\Domain\ModelAggregate\ModelContracts\IModelRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ModelRepository implements IModelRepository
{
    private Model $model;

    public function __construct(Model $Model)
    {
        $this->model = $Model;
    }

    public function saveModel(Model $model): void
    {
        DB::transaction(function () use ($model) {
            $model->save();
        });
    }

    public function findModel(int $modelId): Model
    {
        return $this->model->where('id', $modelId)->first();
    }

    public function updateModel(Model $model): void
    {
        DB::transaction(function () use ($model) {
            if(!empty($model->deleted_at)){
                $model->restore();
            }

            $model->updated_at = now('America/Sao_Paulo');
            $model->update();
        });
    }

    public function deleteModel(Model $model): void
    {
        DB::transaction(function () use($model){
            $model->update();
            $model->delete();
        });
    }
    
    public function findAllModels(): Collection
    {
        return $this->model
            ->whereNull('modelos.deleted_at')
            ->join('marcas', 'modelos.marca_id', '=', 'marcas.id')
            ->select(
                'modelos.nome as modelo_nome',
                'modelos.id as modelo_id',
                'marcas.nome as marca_nome',
                'marcas.id as marca_id',
                'modelos.numero_portas',
                'modelos.lugares',
                'modelos.air_bag',
                'modelos.abs',
            )->get();
    }
}
