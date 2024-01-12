<?php

namespace App\Api\Application\Controllers;

use App\Api\Application\Interfaces\ICarService;
use App\Api\Application\Requests\CarRequest\SaveCarRequest;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    private ICarService $carService;

    public function __construct(ICarService $ICarService)
    {
        $this->carService = $ICarService;
    }

    public function saveCar(SaveCarRequest $request)
    {
        try {
        } catch (\Throwable $th) {
            return response()->json(["Error :" => $th->getMessage()]);
        }
    }
    public function findCar($request)
    {
        try {
        } catch (\Throwable $th) {
            return response()->json(["Error :" => $th->getMessage()]);
        }
    }
    public function updateCar($request)
    {
        try {
        } catch (\Throwable $th) {
            return response()->json(["Error :" => $th->getMessage()]);
        }
    }
    public function deleteCar($request)
    {
        try {
        } catch (\Throwable $th) {
            return response()->json(["Error :" => $th->getMessage()]);
        }
    }
    public function findAllCars($request)
    {
        try {
        } catch (\Throwable $th) {
            return response()->json(["Error :" => $th->getMessage()]);
        }
    }
}
