<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreatePatientRequest extends FormRequest
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
            'date'               => 'required',
            'history_number'     => 'nullable',
            'person_id'          => 'required',
            'age'                => 'required|numeric',
            'weight'             => 'required|max:1000|numeric',
            'gender'             => 'required',
            'place'              => 'required|max:65',
            'birthdate'          => 'required',
            'occupation'         => 'required|string|max:65',
            'profession'         => 'required|max:65',
            'reason'             => 'required',
            'previous_surgery'   => 'required',
            'employe_id'         => 'required',
            // 'another_phone'      => 'required',
            // 'another_email'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'date.required'           => 'La :attribute es obligatorio.',
            'history_number.required' => 'El :attribute es obligatorio.',
            'person_id.required'      => 'El :attribute es obligatorio.',
            'previous_surgery.required' => 'El :attribute es obligatorio.',
            'age.required'            => 'La :attribute es obligatorio.',
            'weight.required'         => 'El :attribute es obligatorio.',
            'gender.required'         => 'El :attribute es obligatorio.',
            'place.required'          => 'El :attribute es obligatorio.',
            'birthdate.required'      => 'La :attribute es obligatorio.',
            'occupation.required'     => 'La :attribute es obligatorio.',
            'employe_id.required'     => 'La :attribute es obligatorio.',
            'profession.required'     => 'La :attribute es obligatorio.',
            'reason.required'         => 'El :attribute es obligatorio',
         //   'another_phone.required'  => 'El :attribute es obligatorio',
         //   'another_email.rquired'   => 'El :attribute es obligatorio',
        ];
    }

    public function attributes()
    {
        return [
            'date'           => 'fecha',
            'history_number' => 'Número de historia',
            'person_id'      => 'el paciente',
            'weight'         => 'peso',
            'age'            => 'edad del paciente',
            'gender'         => 'genero del paciente',
            'place'          => 'lugar de nacimiento del paciente',
            'birthdate'      => 'fecha de nacimiento del paciente',
            'occupation'     => 'ocupacion del paciente',
            'previous_surgery' => 'direccion del paciente',
            'profession'      => 'seleccione profesion',
            'reason'          => 'Motivo de la consulta',
         //   'another_phone'   => 'otro numero',
        //    'another_email'   => 'otro correo',
        ];
    }

}
