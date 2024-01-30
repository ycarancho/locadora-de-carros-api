<?php

namespace App\Api\Application\Controllers;

use App\Api\Application\Interfaces\ICarService;
use App\Api\Application\Requests\CarRequest\DeleteCarRequest;
use App\Api\Application\Requests\CarRequest\FindCarRequest;
use App\Api\Application\Requests\CarRequest\SaveCarRequest;
use App\Api\Application\Requests\CarRequest\UpdateCarRequest;
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
            $this->carService->saveCar($request);
            return response()->json('Carro salvo com sucesso.');
        } catch (\Throwable $th) {
            return response()->json(["Error :" => $th->getMessage()]);
        }
    }
    public function findCar(FindCarRequest $request)
    {
        try {
            $car = $this->carService->findCar($request);
            return response()->json($car);
        } catch (\Throwable $th) {
            return response()->json(["Error :" => $th->getMessage()]);
        }
    }
    public function updateCar(UpdateCarRequest $request)
    {
        try {
            $this->carService->updateCar($request);
            return response()->json("Carro atualizado com Sucesso");
        } catch (\Throwable $th) {
            return response()->json(["Error :" => $th->getMessage()]);
        }
    }
    public function deleteCar(DeleteCarRequest $request)
    {
        try {
            $this->carService->deleteCar($request);
            return response()->json("Carro removido com sucesso.");
        } catch (\Throwable $th) {
            return response()->json(["Error :" => $th->getMessage()]);
        }
    }
    public function findAllCars()
    {
        try {
            $cars = $this->carService->findAllCars();
            return response()->json($cars);
        } catch (\Throwable $th) {
            return response()->json(["Error :" => $th->getMessage()]);
        }
    }
}
