<?php

namespace App\Api\Application\Interfaces;

use App\Api\Application\Requests\CarRequest\SaveCarRequest;

interface ICarService {
    public function saveCar(SaveCarRequest $request);
    public function findCar($request);
    public function updateCar($request);
    public function deleteCar($request);
    public function findAllCars($request);
}