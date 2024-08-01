<?php

namespace App\Http\Requests\Section;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateSectionRequest extends FormRequest
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
            'section_name' => 'required|max:5|unique:sections,section_name'
        ];
    }

    public function messages()
    {
        return [
            'section_name.required' => "El campo de sección es requerido",
            'section_name.max' => "El campo de sección sebe tener como máximo 5 caracteres",
            'section_name.unique' => "El campo de sección debe ser único, registre uno nuevo",
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
