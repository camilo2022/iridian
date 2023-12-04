<?php

namespace App\Http\Requests\Evaluations;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EvaluationsCalculateRequest extends FormRequest
{
    /**
 * Maneja una solicitud fallida de validación.
 *
 * @param \Illuminate\Contracts\Validation\Validator $validator
 * @throws \Illuminate\Validation\ValidationException
 */
protected function failedValidation(Validator $validator)
{
    // Lanzar una excepción de validación con los errores de validación obtenidos
    throw new HttpResponseException(response()->json([
        'message' => 'Error de validación.',
        'errors' => $validator->errors()
    ], 422));
}
/**
 * Determine if the user is authorized to make this request.
 *
 * @return bool
 */
public function authorize()
{
    return true;
}
/**
 * Get the validation rules that apply to the request.
 *
 * @return array<string, mixed>
 */
public function rules()
{
    return [
        'id' => ['required', 'numeric', 'exists:evaluations,id'],
    ];
}

public function messages()
{
    return [
        'required' => 'El campo :attribute es requerido.',
        'numeric' => 'El campo :attribute debe ser numerico.',
        'exists' => 'El campo :attribute no es valido.',
    ];
}

public function attributes()
{
    return [
        'id' => 'identificador de la evaluacion',
    ];
}
}
