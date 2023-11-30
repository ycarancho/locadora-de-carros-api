<?php

namespace App\Api\Application\Interfaces;

use App\Api\Application\Requests\ModelsRequest\saveModelRequest;

interface IModelService
{
    public function saveModel(saveModelRequest $request);
    public function findModel();
    public function updateModel();
    public function deleteModel();
    public function findAllModels();
}
