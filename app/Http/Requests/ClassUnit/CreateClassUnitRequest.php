<?php

namespace App\Http\Requests\ClassUnit;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateClassUnitRequest extends FormRequest
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
            'file' => 'required|file|max:4096',
            'class_unit_title' => 'sometimes|string|max:150',
            'class_unit_description' => 'sometimes|string|max:350',
            'id_teacher_area' => 'required|exists:teacher_areas,id_teacher_area',
            'id_unit' => 'required|exists:units,id_unit',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'El archivo de unidad es requerida',
            'file.file' => 'El archivo de la unidad tiene que ser de tipo file',
            'file.max' => 'El archivo deber como máximo de 4MB',
            'class_unit_title.string' => 'El título del archivo debe ser de tipo string',
            'class_unit_title.max' => 'El título debe ser como máximo 150 caracteres',
            'class_unit_description.string' => 'La descripción del archivo debe ser de tipo string',
            'class_unit_description.max' => 'La descripción del archivo debe ser como máximo 350 caracteres',
            'id_teacher_area.required' => 'El id del docente en el área es requerido',
            'id_teacher_area.exists' => 'El id del docente en el área no se encuentra registrado',
            'id_unit.required' => 'El id de la unidad es requerido',
            'id_unit.exists' => 'El id de la unidad no se encuentra registrado',
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
