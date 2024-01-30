<?php

namespace App\Api\Application\Requests\CarRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UpdateCarRequest extends FormRequest
{

    public int $id_carro;
    public string $placa;
    public bool $disponivel;
    public int $km;


    public function rules(): array
    {
        return [
            "id_carro" => "required|int|exists:carros,id",
            "placa" => "required|string|alpha_num|min:7|max:7",
            "disponivel" => "required|bool",
            "km" => "required",
        ];
    }

    public function messages()
    {
        return [
            "required" => "O :attribute é obrigatorio",
            "int" => "O :attribute precisa ser um int",
            "string" => "O :attribute precisa ser uma string",
            "alpha_num" => "O :attribute precisa ser alfanumérico",
            "bool" => "O :attribute precisa ser boolean",
            "placa.min" => "O :attribute minimo de caracteres necesarios são 7",
            "placa.max" => "O :attribute maximo de caracteres necesarios são 7" 
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

    public function response(): self
    {
        $this->id_carro = $this->input('id_carro');
        $this->placa = $this->input("placa");
        $this->disponivel = $this->input("disponivel");
        $this->km = $this->input("km");

        return $this;
    }
}
