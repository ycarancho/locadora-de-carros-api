<?php

namespace App\Api\Application\Interfaces;

use App\Api\Application\Requests\ClientRequest\FindClientRequest;
use App\Api\Application\Requests\ClientRequest\SaveClientRequest;
use App\Api\Application\Requests\ClientRequest\UpdateClientRequest;
use App\Api\Domain\ClientAggregate\Client;

interface IClientService {
    public function saveClient(SaveClientRequest $request): void;
    public function findClient(FindClientRequest $request): Client;
    public function updateClient(UpdateClientRequest $request): void;
    public function deleteClient( $request): void;
    public function findAllClients();
}