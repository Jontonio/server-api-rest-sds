<?php

namespace App\Http\Requests\Institution;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateInstitutionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "modular_code" => "required|string|min:7|max:8|unique:institutions",
            "name_ie" => "required|string|max:100",
            "level_modality" => "required|string|max:50",
            "management_dependency" => "required|string|max:45",
            "address_ie" => "required|string|max:150",
        ];
    }

    public function messages()
    {
        return [
            "modular_code.required" => "El codigo modular de la institución es requerido",
            "modular_code.string" => "El codigo modular de la institución debe ser string",
            "modular_code.min" => "El codigo modular de la institución debe ser de 7 dígitos",
            "modular_code.max" => "El codigo modular de la institución debe ser de 7 dígitos",
            "modular_code.unique" => "El codigo modular de la institución debe ser único, registre otro código modular",
            "name_ie.required" => "El nombre de la institución es requerido",
            "name_ie.string" => "El nombre de la institución debe ser string",
            "name_ie.max" => "El nombre de la institución debe ser como máximo 100 caracteres",
            "level_modality.required" => "El nivel modalidad debe ser requerido",
            "level_modality.string" => "El nivel modalidad debe ser string",
            "level_modality.max" => "El nivel modalidad debe ser de 50 caracteres como máximo",
            "management_dependency.required" => "La dependencia es requerida",
            "management_dependency.max" => "La dependencia debe ser de 50 caracteres como máximo",
            "management_dependency.string" => "La dependencia sebe ser string",
            "address_ie.required" => "La dirección de la institución es requerida",
            "address_ie.string" => "La dirección de la institución debe ser string",
            "address_ie.max" => "La dirección de la institución debe ser como máximo 150 caracteres",
        ];
    }

    public function failedValidation(Validator $validator)
    {

        $errors = $validator->errors()->toArray();
        $response = [
            'success' => false,
            'message' => 'Error en validación de datos',
            'errors' => $errors,
            'data' => null
        ];

        throw new HttpResponseException(response()->json($response, 422));
    }
}
