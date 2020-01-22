<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updatePersonalDatesRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'lastname' => 'required',
            // 'email' => 'email|required|string|email|max:255',
            'birthdate' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'lastname.required' => 'El :attribute es obligatorio.',
            'email.required' => 'El :attribute es obligatorio.',
            'email.email' => 'El :attribute correo invalido',
            'birthdate.required' => 'La :attribute es obligatorio.',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre del paciente',
            'lastname' => 'apellido del paciente',
            'email' => 'correo del paciente',
            'birthdate' => 'fecha de nacimiento del paciente',  
        ];
    }
}
