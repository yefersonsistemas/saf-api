<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInventoryAreaRequest extends FormRequest
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
            'quantity_Assigned' => 'required',
            'quantity_Used' => 'required',
            'quantity_Available' => 'required',
            'type_area_id' => 'required',
            'inventory_id' => 'required',
        ];
    }
}
