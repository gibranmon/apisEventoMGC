<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoUpdateRequest extends FormRequest
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
            'descripcion' => 'max:250',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del evento es requerido.',
            'nombre.max' => 'El nombre del evento debe ser menor a 100 caracteres.',
            'nombre.min' => 'El nombre del evento debe ser mayor a 3 caracteres.',
            'descripcion.max' => 'La descripción del evento debe ser menor a 250 caracteres.',
        ];
    }
}
