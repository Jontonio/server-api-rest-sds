<?php

namespace App\Http\Requests\TeacherArea;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateTeacherAreaRequest extends FormRequest
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
            'id_area' => 'required|numeric|exists:areas,id_area',
            'id_section' => 'required|numeric|exists:sections,id_section',
            'id_grade' => 'required|numeric|exists:grades,id_grade',
            'id_ie_teacher' => 'required|numeric|exists:institution_teachers,id_ie_teacher',
        ];
    }

    public function messages():array
    {
        return [
            'id_area.required' => 'El id del área es requerido',
            'id_area.numeric' => 'El id del área debe ser númerico',
            'id_area.exists' => 'El área a registrar no se encuentra registrado, registre uno antes de continuar.',
            'id_section.required' => 'El id de la sección es requerido',
            'id_section.numeric' => 'El id de la sección debe ser númerico',
            'id_section.exists' => 'La sección a registrar no se encuentra registrado, registre uno antes de continuar.',
            'id_grade.required' => 'El id del grado es requerido',
            'id_grade.numeric' => 'El id del grado debe ser númerico',
            'id_grade.exists' => 'El grado a registrar no se encuentra registrado, registre uno antes de continuar.',
            'id_ie_teacher.required' => 'El id del docente en la institución es requerido',
            'id_ie_teacher.numeric' => 'El id del docente en la institución debe ser númerico',
            'id_ie_teacher.exists' => 'El docente de la institución a registrar no se encuentra registrado, registre uno antes de continuar.',
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
