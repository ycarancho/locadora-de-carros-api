<?php

namespace App\Api\Application\Requests\BrandRequest;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UpdateBrandRequest extends FormRequest
{
    public $brand_id;
    public $name;
    public $image;

    public function rules()
    {
        return [
            'brand_id' => 'required|integer|exists:marcas,id',
            'name' => 'string',
            'image' => 'file|mimes:jpg,jpeg,png'
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
        $this->brand_id =  $this->input('brand_id');
        $this->name =  $this->input('name');
        $this->image =  $this->file('image');

        return $this;

    }
}
