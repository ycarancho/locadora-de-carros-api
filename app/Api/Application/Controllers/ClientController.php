<?php

namespace App\Api\Application\Controllers;

use App\Api\Application\Interfaces\IClientService;
use App\Api\Application\Requests\ClientRequest\FindClientRequest;
use App\Api\Application\Requests\ClientRequest\SaveClientRequest;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{

    private IClientService $clientService;

    public function __construct(IClientService $ClientService)
    {
        $this->clientService = $ClientService;
    }

    public function saveClient(SaveClientRequest $request)
    {
        try {
            $this->clientService->saveClient($request);
            return response()->json("Novo cliente adicionado");
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function findClient(FindClientRequest $request)
    {
        try {
            $client = $this->clientService->findClient($request);
            return response()->json($client);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}
