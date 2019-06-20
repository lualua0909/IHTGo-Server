<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
        if ($id){
            return [
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required|unique:companies,phone,' . $id,
                'tax' => 'required|unique:companies,tax,' . $id
            ];
        }
        return [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|unique:companies,phone',
            'tax' => 'required|unique:companies,tax'
        ];
    }
}
