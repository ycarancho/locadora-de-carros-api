<?php

namespace App\Api\Infrastructure;

use App\Api\Domain\ClientAggregate\Client;
use App\Api\Domain\ClientAggregate\ClientContracts\IClientRepository;
use Illuminate\Support\Facades\DB;

class ClientRepository implements IClientRepository
{
    private Client $client;
    public function __construct(Client $Client)
    {
        $this->client = $Client;
    }

    public function saveClient(Client $client): void
    {
        DB::transaction(function () use ($client) {
            $client->save();
        });
    }
    public function findClient($client_id): Client
    {
        return $this->client->where('id', $client_id)->first();
    }
    public function updateClient(Client $client): void
    {
        DB::transaction(function() use($client){
            $client->updated_at = now('America/Sao_paulo');
            $client->update();
        });
    }
    public function deleteClient($request): void
    {
    }
    public function findAllClients()
    {
    }
}
