<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDiagnosticRequest extends FormRequest
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
            'reason' => 'required|max:255',
            'description' => 'required',
            'patient_id' => 'required',
            'employe_id' => 'required',
            'treatment' => 'required',
            'annex' => 'required',
            'next_cite' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'reason.required' => 'La :attribute es obligatorio.',
            'description.required' => 'El :attribute es obligatorio.',
            'patient_id.required' => 'El :attribute es obligatorio.',
            'empploye_id.required' => 'El :attribute es obligatorio.',
            'treatment.required' => 'El :attribute es obligatorio.',
            'annex.required' => 'El :attribute es obligatorio.',
            'next_cite.required' => 'El :attribute es obligatorio.',
        ];
    }

    public function attributes()
    {
        return [
            'reason' => 'razón',
            'description' => 'diagnostico',
            'patient_id' => 'paciente',
            'employe_id' => 'doctor',
            'treatment' => 'tratamiento',
            'annex' => 'anexo',
            'next_cite' => 'proxima cita',
        ];
    }

}
