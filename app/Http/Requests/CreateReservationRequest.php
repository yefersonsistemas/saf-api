<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
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
            'type_dni'           => 'required',
            'dni'                => 'required',
            'name'               => 'required',
            'lastname'           => 'required',
            'email'              => 'required',
            'address'            => 'required',
            'phone'              => 'required',
            'speciality'         => 'required',
            'doctor'             => 'required',
            'motivo'             => 'required',
            'date'               => 'required',
            'person'             => 'required',
        ];
    }
}