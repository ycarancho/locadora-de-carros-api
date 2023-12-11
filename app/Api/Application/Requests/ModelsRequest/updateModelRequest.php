<?php

namespace App\Api\Application\Requests\ModelsRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UpdateModelRequest extends FormRequest
{
    public int $id;
    public int $marca_id;
    public string $nome;
    public $imagem;
    public int $numero_portas;
    public int $lugares;
    public bool $air_bag;
    public bool $abs;

    public function rules(): array
    {
        return [
            "id" => "required|int|exists:modelos,id",
            "marca_id" => "required|int|exists:marcas,id",
            "nome" => "string",
            "imagem" => "image|mimes:png,jpeg,jpg",
            "numero_portas" => "int|digits_between:1,4",
            "lugares" => "int|digits_between:1,5",
            "air_bag" => "boolean",
            "abs" => "boolean"
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatorio',
            'doors_numbers:digits_between' => 'O campo :attribute aceita apneas numeros entre 1 e 4',
            'places:digits_between' => 'O campo :attribute aceita apneas numeros entre 1 e 5',
            'boolean' => 'O campo :attribute é do tipo bool'
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

    public function request (): self
    {
        $this->id = $this->input('id');
        $this->nome = $this->input('nome');
        $this->imagem = $this->file('imagem');
        $this->numero_portas = $this->input('numero_portas');
        $this->lugares = $this->input('lugares');
        $this->air_bag = $this->input('air_bag');
        $this->abs = $this->input('abs');

        return $this;
    }
}
