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
        ];
    }

    public function messages()
    {
        return [
            'reason.required' => 'La :attribute es obligatorio.',
            'description.required' => 'El :attribute es obligatorio.',
        ];
    }

    public function attributes()
    {
        return [
            'reason' => 'razón',
            'description' => 'diagnostico',
        ];
    }

}
