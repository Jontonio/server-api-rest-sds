<?php

namespace App\Http\Requests\Permission;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AssignPermissionRequest extends FormRequest
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
            'role' => 'required|array',
            'role.*' => 'required|exists:roles,name',
            'permission' => 'required|array',
            'permission.*' => 'required|exists:permissions,name'
        ];
    }

    public function messages()
    {
        return [
            'role.required' => 'El campo de roles es obligatorio.',
            'role.array' => 'El campo de roles debe ser un array.',
            'role.*.required' => 'Cada rol en el array es obligatorio.',
            'role.*.exists' => 'Cada rol debe existir en la tabla de roles.',
            'permission.required' => 'El campo de permisos es obligatorio.',
            'permission.array' => 'El campo de permisos debe ser un array.',
            'permission.*.required' => 'Cada permiso en el array es obligatorio.',
            'permission.*.exists' => 'Cada permiso debe existir en la tabla de permisos.',
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
