<?php

namespace App\Api\Application\Requests\CarRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class FindCarRequest extends FormRequest
{
    public int $id_carro;

    public function rules(): array
    {
        return [
            'id_carro' => 'required|int|exists:carros,id'
        ];
    }

    public function message(): array
    {
        return [
            'required' => 'O :attribute é obrigatorio',
            'int' => 'O :attribute deve ser um inteiro',
            'exists' => 'Não existe carro com o id informado'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            "message" => "Validation Failed",
            "errors" => $validator->errors()
        ], 422);

        throw new HttpResponseException($response);
    }

    public function request(): self
    {
        $this->id_carro = $this->input('id_carro');
        return $this;
    }
}
