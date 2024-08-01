<?php

namespace App\Http\Requests\AcademicCalendar;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateAcademicCalendarRequest extends FormRequest
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
            'academic_calendar_year' => 'required|numeric|digits:4|unique:academic_calendars,academic_calendar_year'
        ];
    }

    public function messages(): Array {
        return [
            'academic_calendar_year.required' => 'El calendario académico es requerido.',
            'academic_calendar_year.numeric' => 'El calendario académico debe ser númerico.',
            'academic_calendar_year.digits' => 'El calendario académico debe ser como máximo de 4 dígitos.',
            'academic_calendar_year.unique' => 'El año del calendario académico ya exist, registre uno nuevo.',
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
