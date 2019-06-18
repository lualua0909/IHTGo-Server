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
            'manufacturer' => 'required',
            'brand' => 'required',
            'type' => 'required|in:1,2',
            'weight' => 'required',
            'license_plate' => 'required|unique:cars,license_plate',
            'number' => 'required|unique:cars,number',
            'name' => 'required'
        ];
        if ($id){
            $rule['license_plate'] = "required|unique:cars,license_plate,$id";
            $rule['number'] = "required|unique:cars,number,$id";
        }
        return $rule;
    }
}
