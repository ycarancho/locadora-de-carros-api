<?php

namespace App\Api\Application\Services;

use App\Api\Application\Interfaces\ICarService;
use App\Api\Application\Requests\CarRequest\DeleteCarRequest;
use App\Api\Application\Requests\CarRequest\FindCarRequest;
use App\Api\Application\Requests\CarRequest\SaveCarRequest;
use App\Api\Domain\CarAggregate\Car;
use App\Api\Domain\CarAggregate\CarContracts\ICarRepository;
use App\Api\Utils\Guard\Guard;
use Illuminate\Support\Collection;

class CarService implements ICarService
{
    private Guard $guard;
    private ICarRepository $carRepository;
    private $regexBrasilianPlate = '/^[A-Z]{3}\d[A-Z0-9]\d{2}$/';
    public function __construct(Guard $Guard, ICarRepository $ICarRepository)
    {
        $this->carRepository = $ICarRepository;
        $this->guard = $Guard;
    }
    public function saveCar(SaveCarRequest $request): void
    {
        $this->guard->check(!preg_match($this->regexBrasilianPlate, $request->input('placa')), 'A numeração não confere com uma placa de carro');
        $car = new Car(
            $request->input('modelo_id'),
            $request->input('placa'),
            $request->input('disponivel'),
            $request->input('km'),
        );
        $this->carRepository->saveCar($car);
    }
    public function findCar(FindCarRequest $request): car
    {
        return $this->carRepository->findCar($request->input('id_carro'));
    }
    public function updateCar($request)
    {
        $this->guard->check(!preg_match($this->regexBrasilianPlate, $request->input('placa')), 'A numeração não confere com uma placa de carro');

        $car = $this->carRepository->findCar($request->input('id_carro'));

        foreach ($car->getAttributes() as $key => $values) {
            if ($key != 'created_at' && $key != 'updated_at' && $key != 'deleted_at' && $key != 'id' && $key != 'modelo') {
                $car->$key = $request->input($key);
            };
        }
        $this->carRepository->updateCar($car);
    }
    public function deleteCar(DeleteCarRequest $request): void
    {
        $car = $this->carRepository->findCar($request->input('id_carro'));
        $this->carRepository->deleteCar($car);
    }
    public function findAllCars():Collection
    {
        return $this->carRepository->findAllCars();
    }
}
