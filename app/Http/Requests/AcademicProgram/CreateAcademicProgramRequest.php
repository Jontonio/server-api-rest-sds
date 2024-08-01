<?php

namespace App\Http\Requests\AcademicProgram;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateAcademicProgramRequest extends FormRequest
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
            'academic_program_bim' => 'required',
            'academic_program_start' => 'required|date_format:Y-m-d\TH:i',
            'academic_program_finish' => 'required|date_format:Y-m-d\TH:i',
            'id_academic_calendar' => 'required|numeric|exists:academic_calendars,id_academic_calendar'
        ];
    }

    public function messages(): Array {
        return [
            'modular_code.required' => 'El código modular es requerido.',
            'modular_code.string' => 'El código modular debe ser string.',
            'academic_program_bim.required' => 'El perido de la programación académica es requerida.',
            'academic_program_start.required' => 'La fecha de inicio de la programación académica es requerida.',
            'academic_program_start.date_format' => 'La fecha de inicio de la programación académica debe ser date.',
            'academic_program_finish.required' => 'La fecha de final de la programación académica es requerida.',
            'academic_program_finish.date_format' => 'La fecha de final de la programación académica debe ser date.',
            'modular_code.exists' => 'El código modular de la institución debe estar registrada.',
            'id_academic_calendar.required' => 'El parametro id del calendario académico es requerido.',
            'id_academic_calendar.integer' => 'El parametro id del calendario académico debe ser númerico.',
            'id_academic_calendar.exists' => 'El parametro id del calendario académico debe estar registrada.',
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
