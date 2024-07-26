<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAreaRequest extends FormRequest
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
            'area_name ' => 'required|unique:charges|regex:/^[\pL\s]+$/u',
        ];
    }
    public function messages():array
    {
        return [
            'area_name.required' => 'El nombre del area es requerido',
            'area_name.unique' => 'El nombre del area debe ser único',

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
