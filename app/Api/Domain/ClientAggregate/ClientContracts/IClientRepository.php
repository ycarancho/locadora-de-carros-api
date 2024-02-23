<?php

namespace App\Api\Domain\ClientAggregate\ClientContracts;

use App\Api\Domain\ClientAggregate\Client;

interface IClientRepository
{
    public function saveClient(Client $client): void;
    public function findClient(int $request): Client;
    public function updateClient(Client $client): void;
    public function deleteClient($request): void;
    public function findAllClients();
}
