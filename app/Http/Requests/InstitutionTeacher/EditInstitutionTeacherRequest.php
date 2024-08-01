<?php

namespace App\Http\Requests\InstitutionTeacher;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditInstitutionTeacherRequest extends FormRequest
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
            'id_card' => 'required|max:15|exists:teachers,id_card',
            "modular_code" => "required|string|min:7|max:7|exists:institutions",
            "id_college" => "sometimes|numeric|exists:colleges,id_college",
        ];
    }

    public function messages():array
    {
        return [
            'id_card.required' => 'El documento del docente es requerido',
            'id_card.max' => 'El documento del docente debe ser como máximo de 15 caracteres',
            'id_card.exists' => 'El documento del docente no se encuentra registrado, registre uno antes de continuar',
            "modular_code.required" => "El codigo modular de la institución es requerido",
            "modular_code.string" => "El codigo modular de la institución debe ser string",
            "modular_code.min" => "El codigo modular de la institución debe ser de 7 dígitos",
            "modular_code.max" => "El codigo modular de la institución debe ser de 7 dígitos",
            "modular_code.exists" => "El codigo modular de la institución no se encuentra registrado, registre uno antes de continuar",
            "id_college.numeric" => "El id del colegiado debe ser númerico",
            "id_college.exists" => "El id del colegiado no se encuentra registrado, registre uno antes de continuar",
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
