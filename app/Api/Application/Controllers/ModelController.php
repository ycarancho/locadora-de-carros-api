<?php

namespace App\Api\Application\Controllers;

use App\Api\Application\Interfaces\IModelService;
use App\Api\Application\Requests\ModelsRequest\saveModelRequest;
use App\Http\Controllers\Controller;
use Throwable;

class ModelController extends Controller
{

    protected IModelService $modelService;

    public function __construct(ImodelService $ModelService)
    {
        $this->modelService = $ModelService;
    }

    public function saveModel(saveModelRequest $request)
    {
        try {
            $this->modelService->saveModel($request);
            return response()->json("Modelo salvo com sucesso !");
        } catch (Throwable $th) {
            return response()->json(["error" => $th->getMessage()]);
        }
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
