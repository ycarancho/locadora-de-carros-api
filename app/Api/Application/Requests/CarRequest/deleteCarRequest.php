<?php

namespace App\Api\Application\Requests\CarRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class DeleteCarRequest extends FormRequest
{

    public int $id_carro;

    public function rules(): array
    {
        return [
            "id_carro" => "required|int|exists:carros,id"
        ];
    }

    public function messages(): array
    {
        return [
            "required" => "O :attribute é obrigatorio",
            "int" => "O :attribute deve ser inteiro",
            "exists" => "O :attribute não existe na base de dados",
        ];
    }

    public function failedValidation(Validator $validator)
    {

        $response = new JsonResponse([
            "message" => "Failed Validation",
            "errors" => $validator->errors()
        ], 422);

        throw new HttpResponseException($response);
    }

    public function response(): self
    {
        $this->id_carro = $this->input('id_carro');
        return $this;
    }
}
