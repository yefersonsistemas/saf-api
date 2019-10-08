<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCiteRequest extends FormRequest
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
        $rules = [
            'date'               => 'required',
            // 'description'        => 'required',
            // 'status'             => 'required',
            // 'schedule_id'        => 'required',
            // 'doctor_id'          => 'required',
            // 'person_id'          => 'required',
        ];

        return $rules;
    }
}
