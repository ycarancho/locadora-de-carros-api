<?php

namespace App\Api\Application\Services;

use App\Api\Application\Interfaces\IClientService;
use App\Api\Domain\ClientAggregate\Client;
use App\Api\Domain\ClientAggregate\ClientContracts\IClientRepository;
use App\Api\Utils\Guard\Guard;

class ClientService implements IClientService
{
    private Guard $guard;
    private IClientRepository $clientRepository;
    private $regexCPF = '/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/';
    private $regexRG = '/^[0-9]{2}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/';
    // private $regexCEL = '/^([1-9]{2}\) (?:[2-8]|9[0-9])[0-9]{3}\-[0-9]{4}$/';
    private $regexCEL = '/^\([0-9]{2}\)\ 9[0-9]{4}\-[0-9]{4}$/';
    public function __construct(Guard $Guard, IClientRepository $ClientRepository)
    {
        $this->guard = $Guard;
        $this->clientRepository = $ClientRepository;
    }

    public function saveClient($request): void
    {
        $this->guard->check(!preg_match($this->regexCPF, $request->input('cpf')), 'Formato invalido de CPF');
        $this->guard->check(!preg_match($this->regexRG, $request->input('rg')), 'Formato invalido de RG');
        $this->guard->check(!preg_match($this->regexCEL, $request->input('telefone')), 'Formato invalido de Telefone Celular');

      $cliente = new Client(
            $request->input('nome'),
            $request->input('email'),
            $request->input('telefone'),
            $request->input('data_nascimento'),
            $request->input('rua'),
            $request->input('bairro'),
            $request->input('numero'),
            $request->input('cpf'),
            $request->input('rg'),
            $request->input('cnh'),
            $request->input('validade_cnh'),
        );  

        $this->clientRepository->saveClient($cliente);

    }
    public function findClient($request): Client
    {
        return $this->clientRepository->findClient($request->input('client_id'));
    }
    public function updateClient($request)
    {
    }
    public function deleteClient($request): void
    {
    }
    public function findAllClients()
    {
    }
}
