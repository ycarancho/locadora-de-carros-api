<?php

namespace App\Api\Application\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\Application\Interfaces\IBrandService;
use App\Api\Application\Requests\BrandRequest\FindBrandRequest;
use App\Api\Application\Requests\BrandRequest\SaveBrandRequest;
use App\Api\Application\Requests\BrandRequest\UpdateBrandRequest;

class BrandController extends Controller
{
    private IBrandService $brandService;

    public function __construct(IBrandService $IBrandService)
    {
        $this->brandService = $IBrandService;
    }

    public function saveBrand(SaveBrandRequest $request)
    {
        try {
            $this->brandService->saveBrand($request);
            return response()->json(['message' => 'Marca salva com sucesso']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function findAllBrands()
    {
        try {
            $response = $this->brandService->findAllBrands();
            return response()->json($response);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function findBrand(FindBrandRequest $request)
    {
        try {
            $response = $this->brandService->findBrand($request->input('brand_id'));
            return response()->json($response);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function updateBrand(UpdateBrandRequest $request)
    {
        try {
            $this->brandService->updateBrand($request);
            return response()->json(['message' => 'Marca atualizada com sucesso']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function deleteBrand(FindBrandRequest $request)
    {
        try {
            $this->brandService->deleteBrand($request->input('brand_id'));
            return response()->json(['message'=>'Marca removida com sucesso']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
