<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
        $id = $this->id;
        $rule = [
            'manufacturer' => 'required|string|max:30',
            'brand' => 'required|string|max:30',
            'weight' => 'required|string|max:20',
            'license_plate' => 'required|string|max:20|unique:cars,license_plate',
            'number' => 'required|string|max:30|unique:cars,number',
            'name' => 'required|string|max:50'
        ];
        if ($id){
            $rule['license_plate'] = "required|string|max:20|unique:cars,license_plate,$id";
            $rule['number'] = "required|string|max:30|unique:cars,number,$id";
        }
        return $rule;
    }
}
