<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Api\Application\Interfaces\IBrandService;
use App\Api\Application\Interfaces\ICarService;
use App\Api\Application\Interfaces\IClientService;
use App\Api\Application\Interfaces\ILeaseService;
use App\Api\Application\Interfaces\IModelService;
use App\Api\Application\Services\BrandService;
use App\Api\Application\Services\CarService;
use App\Api\Application\Services\ClientService;
use App\Api\Application\Services\LeaseService;
use App\Api\Application\Services\ModelService;
use App\Api\Domain\BrandAggregate\BrandContracts\IBrandRepository;
use App\Api\Domain\CarAggregate\CarContracts\ICarRepository;
use App\Api\Domain\ClientAggregate\ClientContracts\IClientRepository;
use App\Api\Domain\LeaseAggregate\LeaseContracts\ILeaseRepository;
use App\Api\Domain\ModelAggregate\ModelContracts\IModelRepository;
use App\Api\Infrastructure\BrandRepository;
use App\Api\Infrastructure\CarRepository;
use App\Api\Infrastructure\ClientRepository;
use App\Api\Infrastructure\LeaseRepository;
use App\Api\Infrastructure\ModelRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IBrandService::class, BrandService::class);
        $this->app->bind(IBrandRepository::class, BrandRepository::class);

        $this->app->bind(IModelService::class, ModelService::class);
        $this->app->bind(IModelRepository::class, ModelRepository::class);

        $this->app->bind(ICarService::class, CarService::class);
        $this->app->bind(ICarRepository::class, CarRepository::class);

        $this->app->bind(IClientService::class, ClientService::class);
        $this->app->bind(IClientRepository::class, ClientRepository::class);

        $this->app->bind(ILeaseService::class, LeaseService::class);
        $this->app->bind(ILeaseRepository::class, LeaseRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
