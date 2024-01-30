<?php

namespace App\Api\Domain\CarAggregate\CarContracts;

use App\Api\Domain\CarAggregate\Car;
use Illuminate\Support\Collection;

interface ICarRepository
{
    public function saveCar(Car $car): void;
    public function findCar(int $carId): Car;
    public function updateCar(Car $car): void;
    public function deleteCar(Car $car): void;
    public function findAllCars(): Collection;
}
