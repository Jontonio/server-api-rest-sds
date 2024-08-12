<?php

namespace App\Http\Requests\Unit;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditUnitRequest extends FormRequest
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
            'unit_start' => 'sometimes|date_format:Y-m-d\TH:i',
            'unit_finish' => 'sometimes|date_format:Y-m-d\TH:i',
            'unit_name' => 'sometimes|nullable|string|max:20',
            'unit_description' => 'sometimes|nullable|string|max:350',
            'id_academic_program' => 'sometimes|exists:academic_programs,id_academic_program',
        ];
    }

    public function messages(): array
    {
        return [
            'unit_start.required' => 'El fecha de inicio de unidad es requerido',
            'unit_start.date_format' => 'El fecha de inicio de unidad debe ser en formato (Y-m-d\TH:i)',
            'unit_finish.required' => 'El campo de final de unidad es requerido',
            'unit_finish.date_format' => 'El fecha final de unidad debe ser en formato (Y-m-d\TH:i)',
            'unit_name.string' => 'El nombre de unidad es requerido',
            'unit_name.max' => 'El nombre de unidad debe ser como máximo de 20 caracteres',
            'unit_description.required' => 'El campo es requerido',
            'unit_description.max' => 'La descripción de unidad debe ser como máximo de 350 caracteres',
            'id_academic_program.required' => 'El campo id de la programación académica es requerida',
            'id_academic_program.exists' => 'El campo id de la programación académica no se encuentra registrado',
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
