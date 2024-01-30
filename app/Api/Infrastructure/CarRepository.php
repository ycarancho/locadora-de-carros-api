<?php

namespace App\Api\Infrastructure;

use App\Api\Domain\CarAggregate\Car;
use App\Api\Domain\CarAggregate\CarContracts\ICarRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Driver\Selector;

class CarRepository implements ICarRepository
{
    private Car $car;
    public function __construct(Car $Car)
    {
        $this->car = $Car;
    }

    public function saveCar(Car $car): void
    {
        DB::transaction(function () use ($car) {
            $car->save();
        });
    }

    public function findCar(int $carId): car
    {
        return $this->car->where('carros.id', $carId)
            ->join('modelos', 'carros.modelo_id', '=', 'modelos.id')
            ->select(
                'carros.id',
                'modelos.nome as modelo',
                'carros.placa',
                'carros.disponivel',
                'carros.km',
                'carros.created_at',
                'carros.updated_at',
                'carros.deleted_at'
            )->first();
    }

    public function updateCar(Car $car): void
    {
        DB::transaction(function () use ($car) {
            if (!empty($car->deleted_at)) {
                $car->restore();
            }
            $car->updated_at = now('America/Sao_Paulo');
            $car->update();
        });
    }

    public function deleteCar(Car $car): void
    {
        DB::transaction(function () use ($car) {
            $car->updated_at = now('America/Sao_Paulo');
            $car->delete();
        });
    }

    public function findAllCars(): Collection
    {
        return collect($this->car->whereNull('carros.deleted_at')
            ->join('modelos', 'carros.modelo_id', '=', 'modelos.id')
            ->select(
                'carros.id',
                'modelos.nome as modelo',
                'carros.placa',
                'carros.disponivel',
                'carros.km',
                'carros.created_at',
                'carros.updated_at',
                'carros.deleted_at'
            )->get());
    }
}
