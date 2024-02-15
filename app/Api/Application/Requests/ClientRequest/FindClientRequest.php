<?php

namespace App\Api\Application\Requests\ClientRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class FindClientRequest extends FormRequest
{

    public int $client_id;

    public function rules(): array
    {
        return [
            "client_id" => "required|int|exists:clientes,id"
        ];
    }

    public function messages(): array
    {
        return [
            "required" => "O :attribute é obrigatório.",
            "int" => "O :attribute deve ser um número inteiro.",
            "exists" => "O cliente informado não existe."
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            "message" => "Validation Failed",
            "error" => $validator->errors()
        ]);

        throw new HttpResponseException($response);
    }

    public function request(): self
    {
        $this->client_id  = $this->input('client_id');

        return $this;
    }
}
