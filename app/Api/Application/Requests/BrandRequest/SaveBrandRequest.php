<?php

namespace App\Api\Application\Requests\BrandRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;


class SaveBrandRequest extends FormRequest
{
    public string $name;
    public $image;

    public function rules()
    {
        return [
            'name' => 'required|string|unique:marcas,nome',
            'image' => 'required|file|mimes:jpeg,jpg,png'
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
        $this->name = $this->input('name');
        $this->image = $this->file('image');
        
        return $this;
    }
}
