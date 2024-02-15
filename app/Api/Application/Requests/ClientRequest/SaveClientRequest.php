<?php

namespace App\Api\Application\Requests\ClientRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class SaveClientRequest extends FormRequest
{
    public string $nome;
    public string $email;
    public string $telefone;
    public string $data_nascimento;
    public string $rua;
    public string $bairro;
    public int $numero;
    public string $cpf;
    public string $rg;
    public string $cnh;
    public string $validade_cnh;

    public function  rules(): array
    {
        return [
            "nome" => "required|string|min:3,35",
            "email" => "required|email:rfc,dns",
            "telefone" => "required|string|max:15",
            "data_nascimento" => "required|date",
            "rua" => "required|string|max:200",
            "bairro" => "required|string|max:60",
            "numero" => "required|integer|digits_between:1,1000",
            "cpf" => "required|string|max:20",
            "rg" => "required|string|max:20",
            "cnh" => "required|string|max:20",
            "validade_cnh" => "required|date"
        ];
    }

    public function message(): array
    {
        return [
            "required" => "O :attribute é obrigatório.",
            "string" => "O :attribute deve ser uma string.",
            "min" => "O tamanho do :attribute deve ter no mínimo :min caracteres.",
            "max" => "O tamanho do :attribute deve ter no máximo :max caracteres.",
            "numeric" => "O :attribute deve ser um número.",
            "date" => "O :attribute  deve ser uma data.",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            "message" => "Validation Failed",
            "errors" => $validator->errors(),
        ], 422);

        throw new HttpResponseException($response);
    }

    public function request(): self
    {
        $this->nome = $this->input('nome');
        $this->email = $this->input('email');
        $this->telefone = $this->input('telefone');
        $this->data_nascimento = $this->input('data_nascimento');
        $this->rua = $this->input('rua');
        $this->bairro = $this->input('bairro');
        $this->numero = $this->input('numero');
        $this->cpf = $this->input('cpf');
        $this->rg = $this->input('rg');
        $this->cnh = $this->input('cnh');
        $this->validade_cnh = $this->input('validade_cnh');
        return $this;
    }
}
