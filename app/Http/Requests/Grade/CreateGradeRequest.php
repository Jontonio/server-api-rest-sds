<?php

namespace App\Http\Requests\Grade;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateGradeRequest extends FormRequest
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
            'grade_name' => 'required|numeric|digits:1|unique:grades,grade_name'
        ];
    }

    public function messages()
    {
        return [
            'grade_name.required' => "El campo grado es requerido",
            'grade_name.numeric' => "El campo grado debe ser númerico",
            'grade_name.digits' => "El campo grado debe tener como maximo de un dígito",
            'grade_name.unique' => "El campo grado debe ser único, registre uno nuevo",
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
