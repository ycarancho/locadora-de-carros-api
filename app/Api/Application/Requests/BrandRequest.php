<?php

namespace App\Api\Application\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;


class BrandRequest extends FormRequest
{
    public $name;
    public $image;

    public function rules()
    {
        return [
            'name' => 'required|string|exists:marcas,nome',
            'image' => 'required|file|mimes:jpg,jpeg'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatorio',
            'string' => 'O campo :attribute deve ser uma string.',
            'exists' => 'O campo :attribute já existe',
            'mimes' => 'A imagem precisa estar em formato jpg ou jpeg.'
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
        $this->name = $this->input('name');
        $this->image = $this->file('image');
        
        return $this;
    }
}