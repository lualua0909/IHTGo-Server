<?php

namespace App\Http\Requests;

use App\Models\Driver;
use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
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
        if ($this->id){
            $id = Driver::find($this->id)->user_id;
            return [
                'name' => 'required|string|max:255',
                'email' => "required|string|email|max:255|unique:users,email,$id",
                'phone' => 'required|string|min:10|max:15',
                'identification' => 'required|max:50',
                'experience' => 'required|max:15',
                'date' => 'required|date_format:d/m/Y',
                'warehouse_id' => 'required|exists:warehouses,id'
            ];
        }
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|min:10|max:15',
            'identification' => 'required',
            'experience' => 'required',
            'date' => 'required|date_format:d/m/Y',
            'warehouse_id' => 'required|exists:warehouses,id'
        ];
    }
}
