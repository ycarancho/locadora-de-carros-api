<?php

namespace App\Api\Application\Interfaces;

use App\Api\Application\Requests\CarRequest\DeleteCarRequest;
use App\Api\Application\Requests\CarRequest\FindCarRequest;
use App\Api\Application\Requests\CarRequest\SaveCarRequest;
use App\Api\Application\Requests\CarRequest\UpdateCarRequest;
use App\Api\Domain\CarAggregate\Car;
use Illuminate\Support\Collection;

interface ICarService {
    public function saveCar(SaveCarRequest $request): void;
    public function findCar(FindCarRequest $request): Car;
    public function updateCar(UpdateCarRequest $request);
    public function deleteCar(DeleteCarRequest $request): void;
    public function findAllCars():Collection;
}