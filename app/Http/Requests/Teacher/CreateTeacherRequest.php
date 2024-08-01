<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateTeacherRequest extends FormRequest
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
            'id_card' => 'required|max:15|unique:teachers,id_card',
            'type_id_card' => 'required|max:20',
            'names' => 'required|max:50',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|max:100|unique:teachers,email',
            'phone_number' => 'required|max:10',
        ];
    }

    public function messages():array
    {
        return [
            'id_card.required' => 'El documento del docente es requerido',
            'id_card.max' => 'El documento del docente debe ser como máximo de 15 caracteres',
            'id_card.unique' => 'El documento del docente debe ser único, registre uno nuevo.',
            'type_id_card.required' => 'El tipo de documento del docente es requerido',
            'type_id_card.max' => 'El tipo de documento del docente debe ser como máximo de 20 caracteres',
            'names.required' => 'El nombre del docente es requerido',
            'names.max' => 'El nombre del docente debe ser como máximo de 50 caracteres',
            'first_name.required' => 'El apellido paterno del docente debe ser requerido',
            'first_name.max' => 'El apellido paterno debe ser como máximo de 50 caracteres',
            'last_name.required' => 'El apellido materno del docente debe ser requerido',
            'last_name.max' => 'El apellido materno debe ser como máximo de 50 caracteres',
            'email.required' => 'El email del docente es requerido',
            'email.email' => 'El email del docente es inválido',
            'email.max' => 'El email del docente debe ser como máximo de 100 caracteres',
            'email.unique' => 'El email del docente debe ser único, registre uno nuevo',
            'phone_number.required' => 'El celular del docente es requerido',
            'phone_number.max' => 'El celular del docente debe ser como máximo de 10 dígitos',
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
