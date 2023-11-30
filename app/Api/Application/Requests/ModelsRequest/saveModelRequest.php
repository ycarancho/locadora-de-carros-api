<?php
namespace App\Api\Application\Requests\ModelsRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class saveModelRequest extends FormRequest
{
    public int $brand_id;
    public string $name;
    public $image;
    public int $doors_numbers;
    public int $places;
    public bool $air_bag;
    public bool $abs;

    public function rules()
    {
        return [
            'brand_id' => 'required|int|exists:marcas,id',
            'name' => 'required|string',
            'image' => 'required|image|mimes:png,jpeg,jpg',
            'doors_numbers' => 'required|int|digits_between:1,4',
            'places' => 'required|int|digits_between:1,5',
            'air_bag' => 'required|boolean',
            'abs' => 'required|boolean'
        ];
    }

    public function messages()
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
            "error" => $validator->errors()
        ], 422);

        throw new HttpResponseException($response);
    }

    public function request(): self
    {
        $this->brand_id = $this->input('brand_id');
        $this->name = $this->input('name');
        $this->image = $this->file('image');
        $this->doors_numbers = $this->input('doors_numbers');
        $this->places = $this->input('places');
        $this->air_bag = $this->input('air_bag');
        $this->abs = $this->input('abs');

        return $this;
    }
}
