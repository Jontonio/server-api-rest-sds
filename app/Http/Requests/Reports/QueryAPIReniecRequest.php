<?php

namespace App\Http\Requests\Reports;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class QueryAPIReniecRequest extends FormRequest
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
            "id_card" => "required|numeric|digits:8"
        ];
    }

    public function messages(): Array {
        return [
            "id_card.required" => "el DNI de la persona es requerido",
            "id_card.numeric" => "el DNI de la persona debe ser numérico",
            "id_card.digits" => "el DNI de la persona debe tener 8 digitos numericos",
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
