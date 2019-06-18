<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseRequest extends FormRequest
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
            'code' => 'required|string|max:255|unique:warehouses,code',
            'distribution' => 'required|string|max:250',
            'acreage' => 'required|string|max:255',
            'address' => 'required|string|max:250',
            'manager_id' => 'required|exists:users,id'
        ];
    }
}
