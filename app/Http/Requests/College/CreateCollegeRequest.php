<?php

namespace App\Http\Requests\College;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateCollegeRequest extends FormRequest
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
            'name_college' => 'required|string|max:150|unique:colleges,name_college',
        ];
    }

    public function  messages(): array
    {
        return [
            'name_college.required' => 'El nombre del colegiado es requerido.',
            'name_college.string' => 'El nombre del colegiado debe ser string.',
            'name_college.max' => 'El nombre del colegiado debe ser como máximo de 150 caracteres.',
            'name_college.unique' => 'El colegiado ya se encuentra registrado, intente con uno nuevo.',
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
