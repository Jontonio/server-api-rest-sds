<?php

namespace App\Http\Requests\Area;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateAreaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'area_name' => 'required|string|max:200|unique:areas,area_name',
        ];
    }

    public function  messages(): array
    {
        return [
            'area_name.required' => 'El campo del nombre de area es requerido.',
            'area_name.string' => 'El campo del nombre de area debe ser string.',
            'area_name.max' => 'El campo del nombre de area debe ser como máximo de 20 caracteres.',
            'area_name.unique' => 'El área ya se encuentra registrada, intente con uno nuevo.',
        ];
    }

    public function failedValidation(Validator $validator)
    {

        $errors = $validator->errors()->toArray();
        $response = [
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $errors,
            'data' => null
        ];

        throw new HttpResponseException(response()->json($response, 422));
    }
}
