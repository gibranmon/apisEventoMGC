<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlumnoStoreRequest extends FormRequest
{
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
            'nombre' => 'required|min:3|max:100',
            'matricula' => 'min:3|max:100',
            'telefono' => 'min:10|max:20'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del alumno(a) es requerido.',
            'nombre.max' => 'El nombre del alumno(a) debe ser menor a 100 caracteres.',
            'nombre.min' => 'El nombre del alumno(a) debe ser mayor a 3 caracteres.',
            'matricula.max' => 'La matricula del alumno debe ser menor a 100 caracteres.',
            'matricula.min' => 'La matricula del alumno debe ser mayor a 3 caracteres.',
            'telefono.max' => 'El telefono del alumno debe ser menor a 20 caracteres.',
            'telefono.min' => 'El telefono del alumno debe ser mayor a 10 caracteres.',
        ];
    }
}
