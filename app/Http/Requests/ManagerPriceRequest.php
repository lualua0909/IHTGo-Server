<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 8/10/18
 * Time: 22:55
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ManagerPriceRequest extends FormRequest
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
            'min' => 'required',
            'min_value' => 'required',
        ];
        if ($id){
            $rule['license_plate'] = "required|unique:cars,license_plate,$id";
            $rule['number'] = "required|unique:cars,number,$id";
        }
        return $rule;
    }
}