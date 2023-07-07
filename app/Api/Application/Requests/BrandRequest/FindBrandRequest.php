<?php

namespace App\Api\Application\Requests\BrandRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class FindBrandRequest extends FormRequest
{
    public $brand_id;

    public function rules()
    {
        return [
            "brand_id" => "required|integer|exists:marcas,id"
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute é obrigatorio',
            'integer'   => ':attribute deve ser um inteiro.',
            'exists' => ':attributes não existe no banco'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            "message" => "Validation Failed",
            "erros" => $validator->errors()
        ], 422);

        throw new HttpResponseException($response);
    }

    public function response(): self
    {
        $this->brand_id = $this->input('brand_id');

        return $this;
    }
}
