<?php

namespace App\Api\Application\Requests\CarRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class SaveCarRequest extends FormRequest
{
    public int $modelo_id;
    public string $placa;
    public bool $disponivel;
    public int $km;

    public function rules(): array
    {
        return [
            "modelo_id"=> "required|int|exists:modelos,id",
            "placa"=> "required|string|",
            "disponivel"=>"required|bool",
            "km"=>"required",  
        ];
    }

    public function messages():array{
        return[
            "required"=> "O campo :attribute é obrigatorio",
            "int"=> "O campo :attribute precisa ser inteiro",
            "string"=> "O campo :attribute precisa ser string",
            "bool"=> "O campo :attribute precisa ser boolean",
        ];
    }

    public function failedValidation (Validator $validator){
        $response = new JsonResponse([
            "message"=> "Validation Failed",
            "errors"=> $validator->errors(),
        ], 422);

        throw new HttpResponseException($response);
        
    }

    public function response ():self{
        $this->modelo_id = $this->input("modelo_id");
        $this->placa = $this->input("placa");
        $this->disponivel = $this->input("disponivel");
        $this->km = $this->input("km");

        return $this;
    }

}
