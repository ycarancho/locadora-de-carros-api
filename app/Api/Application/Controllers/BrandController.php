<?php

namespace App\Api\Application\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\Application\Interfaces\IBrandService;
use App\Api\Application\Requests\BrandRequest;

class BrandController extends Controller
{
    private IBrandService $brandService;
    
    public function __construct(IBrandService $IBrandService)
    {
        $this->brandService = $IBrandService;
    }

    public function saveBrand(BrandRequest $request)
    {
        try{
            $this->brandService->saveBrand($request);
            return response()->json(['message'=>'Marca salva com sucesso']);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
