<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id_card_user' => 'required|unique:users',
            'surname_user' => 'required',
            'id_inia_station' => 'sometimes|numeric|exists:inia_stations,id_inia_station',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del usuario es requerido',
            'name.string' => 'El nombre del usuario debe ser string',
            'name.max' => 'El nombre del usuario debe tener como máximo 255 caracteres',
            'email.required' => 'El email del usuario es requerido',
            'email.string' => 'El email del usuario debe ser string',
            'email.max' => 'El email del usuario debe tener como máximo 255 caracteres',
            'email.unique' => 'El email del usuario debe ser único, registre otro email',
            'password.required' => 'El password del usuario es requerido',
            'password.min' => 'El password del usuario debe tener mínimo 6 digitos alfanumericos',
            'id_card_user.required' => 'El DNI del usuario es requerido',
            'id_card_user.unique' => 'El DNI del usuario debe ser único, registre otro DNI',
            'surname_user.required' => 'Los apellidos del usuario es requerido',
            'id_inia_station.exists' => 'La estación que intenta asignar al usuario aún no se encuentra registrado'
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
