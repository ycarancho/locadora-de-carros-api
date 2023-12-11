<?php

namespace App\Api\Application\Requests\BrandRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;


class SaveBrandRequest extends FormRequest
{
    public string $nome;
    public $imagem;

    public function rules()
    {
        return [
            'nome' => 'required|string|unique:marcas,nome',
            'imagem' => 'required|image|mimes:jpeg,jpg,png'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatorio',
            'string' => 'O campo :attribute deve ser uma string.',
            'unique' => 'O campo :attribute já existe',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            "message" => "Validation Failed",
            "errors" => $validator->errors()
        ], 422);

        throw new HttpResponseException($response);
    }

    public function response(): self
    {
        $this->nome = $this->input('nome');
        $this->imagem = $this->file('imagem');
        
        return $this;
    }
}
