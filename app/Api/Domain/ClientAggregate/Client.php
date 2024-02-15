<?php

namespace App\Api\Domain\ClientAggregate;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "clientes";
    protected $filable = [
        "nome",
        "email",
        "telefone",
        "data_nascimento",
        "rua",
        "bairro",
        "numero",
        "cpf",
        "rg",
        "cnh",
        "validade_cnh",
    ];

    public function __construct()
    {
        $numberOfArguments = func_num_args();

        if($numberOfArguments > 0){
            $arguments = func_get_args();
            call_user_func_array([$this, "builder"], $arguments);
        }
    }

    public function builder(
        string $nome,
        string $email,
        string $telefone,
        string $data_nascimento,
        string $rua,
        string $bairro,
        int $numero,
        string $cpf,
        string $rg,
        string $cnh,
        string $validade_cnh
    ){
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->data_nascimento = $data_nascimento;
        $this->rua = $rua;
        $this->bairro = $bairro;
        $this->numero = $numero;
        $this->cpf = $cpf;
        $this->rg = $rg;
        $this->cnh = $cnh;
        $this->validade_cnh = $validade_cnh;
    }
}
