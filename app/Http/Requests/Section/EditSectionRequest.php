<?php

namespace App\Http\Requests\Section;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class EditSectionRequest extends FormRequest
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
        $id = $this->route('id_section'); // Obtener el ID de la ruta

        return [
            'section_name' => [
                'sometimes',
                'max:5',
                Rule::unique('sections')->ignore($id, 'id_section')
            ],
        ];
    }

    public function messages()
    {
        return [
            'section_name.required' => "El campo se sección es requerido",
            'section_name.max' => "El campo se sección sebe tener como máximo 5 caracteres",
            'section_name.unique' => "El campo se sección debe ser único, registre uno nuevo",
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
