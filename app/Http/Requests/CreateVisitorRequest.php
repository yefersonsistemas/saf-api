<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVisitorRequest extends FormRequest
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
            'type_dni'  =>  'required|min:1',
            'dni'       =>  'required|min:6|numeric',
            'name'      =>  'required|string',
            'lastname'  =>  'required|strign',
            'address'   =>  'required|string',
            'phone'     =>  'required|numeric',
            'email'     =>  'required|email',
            'file'      =>  'file|image|nullable',
        ];
    }

    public function messages()
    {
        return [
            'type_dni'  =>  'el tipo de documento es obligatorio',
        ];
    }
}
