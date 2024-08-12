<?php

namespace App\Http\Requests\ClassUnit;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateVerifiedClassUnitRequest extends FormRequest
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
           'verified' => 'required|boolean',
       ];
   }

   public function messages()
   {
       return [
           'verified.required' => 'El campo de verificación de la unidad de clase es requerida',
           'verified.boolean' => 'El campo de verificación debe ser boolean',
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
