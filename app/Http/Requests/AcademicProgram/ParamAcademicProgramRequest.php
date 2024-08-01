<?php

namespace App\Http\Requests\AcademicProgram;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ParamAcademicProgramRequest extends FormRequest
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
            'modular_code' => 'required|string|exists:institutions,modular_code',
            'id_academic_calendar' => 'required|integer|exists:academic_calendars,id_academic_calendar',
        ];
    }
    public function messages(): Array {
        return [
            'modular_code.required' => 'El parametro código modular es requerido.',
            'modular_code.string' => 'El parametro código modular debe ser string.',
            'modular_code.exists' => 'El código modular de la institución debe estar registrada.',
            'id_academic_calendar.required' => 'El parametro id del calendario académico es requerido.',
            'id_academic_calendar.integer' => 'El parametro id del calendario académico debe ser númerico.',
            'id_academic_calendar.exists' => 'El parametro id del calendario académico debe estar registrada.',
        ];
    }

    // Si los parámetros son de la URL, añade esto:
    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
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
