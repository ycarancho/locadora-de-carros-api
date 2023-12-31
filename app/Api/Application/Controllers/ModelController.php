<?php

namespace App\Api\Application\Controllers;

use App\Api\Application\Interfaces\IModelService;
use App\Api\Application\Requests\ModelsRequest\FindModelRequest;
use App\Api\Application\Requests\ModelsRequest\SaveModelRequest;
use App\Api\Application\Requests\ModelsRequest\UpdateModelRequest;
use App\Http\Controllers\Controller;
use Throwable;

class ModelController extends Controller
{

    protected IModelService $modelService;

    public function __construct(ImodelService $ModelService)
    {
        $this->modelService = $ModelService;
    }

    /**
     * @param SaveModelRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveModel(SaveModelRequest $request)
    {
        try {
            $this->modelService->saveModel($request);
            return response()->json(["Message" => "Modelo salvo com sucesso !"]);
        } catch (Throwable $th) {
            return response()->json(["error" => $th->getMessage()]);
        }
    }

    /**
     * @param FindModelRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function findModel(FindModelRequest $request)
    {
        try {
            $model = $this->modelService->findModel($request);
            return response()->json($model);
        } catch (Throwable $th) {
            return response()->json(["error" => $th->getMessage()]);
        }
    }
    /**
     * @param UpdateModelRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateModel(UpdateModelRequest $request)
    {
        try {
            $this->modelService->updateModel($request);
            return response()->json(["Message" => "Modelo atualizado"]);
        } catch (Throwable $th) {
            return response()->json(["error"=> $th->getMessage()]);
        }
    }
    /**
     * @param FindModelRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteModel(FindModelRequest $request)
    {
        try {
            $this->modelService->deleteModel($request);
            return response()->json(["message" => "Registro removido"]);
        } catch (Throwable $th) {
            return response()->json(["error"=> $th->getMessage()]);
        }
    }

    /**
     * @param void
     * @return \Illuminate\Http\JsonResponse
     */
    public function findAllModels()
    {
        try {
            $models = $this->modelService->findAllModels();
            return response()->json($models);
        } catch (Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
}
