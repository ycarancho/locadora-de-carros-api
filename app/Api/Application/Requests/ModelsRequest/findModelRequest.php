<?php

namespace App\Api\Application\Requests\ModelsRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class FindModelRequest extends FormRequest
{
    public int $id;

    public function rules()
    {
        return [
            'id' => 'required|int|exists:modelos,id'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O :attribute é obrigatorio',
            'int' => 'O :attribute precisa ser inteiro',
            'exists' => 'O :attribute não existe ná tabela modelos'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        return new JsonResponse([
            "message" => "Validation Failed",
            "error" => $validator->errors()
        ], 422);
    }

    public function request(): self
    {
        $this->id = $this->input('id');
        return $this;
    }
}
