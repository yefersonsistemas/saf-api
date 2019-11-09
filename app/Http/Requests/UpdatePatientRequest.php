<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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
            // 'date'           => 'required',
            // 'history_number' => 'required',
            // 'name'           => 'required|string|max:40',
            // 'lastname'       => 'required|string|max:65',
            // 'dni'            => 'integer|required|min:7',
            // 'email'          => 'email|required',
            // 'phone'          => 'required',
            // 'age'            => 'required|numeric',
            // 'weight'         => 'required|max:1000|numeric',
            // 'gender'         => 'required',
            // 'place'          => 'required|max:65',
            // 'birthdate'      => 'required',
            // 'occupation'     => 'required|string|max:65',
            // 'address'        => 'required|max:255',
            // 'profession'     => 'required|max:65',
            // 'reason'         => 'required',
            'date'               => 'required',
            'history_number'     => 'nullable',
            'reason'             => 'required',
            'person_id'          => 'required',
            'age'                => 'required|numeric',
            'weight'             => 'required|max:1000|numeric',
            'gender'             => 'required',
            'place'              => 'required|max:65',
            'birthdate'          => 'required',
            'occupation'         => 'required|string|max:65',
            'profession'         => 'required|max:65',
            'reason'             => 'required',
            //'previous_surgery'   => 'required',
            'employe_id'         => 'required',
            // 'another_phone'      => 'required',
            // 'another_email'      => 'required',
        ];

    }

    public function messages()
    {
        return [
            'name.required'           => 'El :attribute es obligatorio.',
            'history_number.required' => 'El :attribute es obligatorio.',
            'reason.required'         => 'El :attribute es obligatorio.',
            'lastname.required'       => 'El :attribute es obligatorio.',
            'dni.required'            => 'La :attribute es obligatorio.',
            'dni.integer'             => 'La :attribute tiene que ser numerico.',
            'dni.unique'              => 'La :attribute ya esta registrado.',
            'dni.min'                 => 'La :attribute tiene que ser minimo 7 digito.',
            'email.required'          => 'El :attribute es obligatorio.',
            'email.email'             => 'El :attribute correo invalido',
            'phone.required'          => 'El :attribute es obligatorio.',
            'age.required'            => 'La :attribute es obligatorio.',
            'weight.required'         => 'El :attribute es obligatorio.',

            'gender.required'         => 'El :attribute es obligatorio.',
            'place.required'          => 'El :attribute es obligatorio.',
            'birthdate.required'      => 'La :attribute es obligatorio.',
            'occupation.required'     => 'La :attribute es obligatorio.',
            'address.required'        => 'La :attribute es obligatorio.',
            'profession.required'     => ':attribute es obligatorio.',
        ];
    }

    public function attributes()
    {
        return [
            'name'           => 'nombre del paciente',
            'lastname'       => 'apellido del paciente',
            'dni'            => 'cedula del paciente',
            'email'          => 'correo del paciente',
            'phone'          => 'telefono del paciente',
            'age'            => 'edad del paciente',
            'gender'         => 'genero del paciente',
            'place'          => 'lugar de nacimiento del paciente',
            'birthdate'      => 'fecha de nacimiento del paciente',
            'occupation'     => 'ocupacion del paciente',
            'address'        => 'direccion del paciente',
            'profession'     => 'seleccione profesion',
            'history_number' => 'Numero de historia',
            'reason'         => 'Motivo de la consulta',
        ];
    }
}
