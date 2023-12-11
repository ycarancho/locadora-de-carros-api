<?php

namespace App\Api\Application\Requests\BrandRequest;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UpdateBrandRequest extends FormRequest
{
    public $id;
    public $nome;
    public $imagem;

    public function rules()
    {
        return [
            'id' => 'required|integer|exists:marcas,id',
            'nome' => 'string',
            'imagem' => 'image|mimes:jpg,jpeg,png'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O :attribute é obrigatorio',
            'string' => 'O :attribute deve ser uma string.',
            'integer' => 'O :attribute deve ser um inteiro.',
            'mimes' => 'A imagem precisa estar em formato jpg, jpeg ou png.'
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
        $this->id =  $this->input('id');
        $this->nome =  $this->input('nome');
        $this->imagem =  $this->file('imagem');

        return $this;

    }
}
