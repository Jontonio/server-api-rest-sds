<?php

namespace App\Http\Requests\InstitutionTeacher;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ParamInstitutionTeacherRequest extends FormRequest
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
            'id_ie_teacher' => 'sometimes|numeric|exists:institution_teachers,id_ie_teacher',
            'id_unit' => 'required|numeric|exists:units,id_unit',
        ];
    }
    public function messages(): Array {
        return [
            'id_ie_teacher.required' => 'El parametro id del docente asignado a la institutción es requerido.',
            'id_ie_teacher.integer' => 'El parametro id del docente asignado a la institutción debe ser númerico.',
            'id_ie_teacher.exists' => 'El parametro id del docente asignado a la institutción debe estar registrada.',
            'id_unit.required' => 'El parametro id de la unidad es requerido.',
            'id_unit.integer' => 'El parametro id de la unidad debe ser númerico.',
            'id_unit.exists' => 'El parametro id de la unidad debe estar registrada.',
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
