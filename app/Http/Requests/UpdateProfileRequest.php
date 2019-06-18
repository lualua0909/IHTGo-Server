<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
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
        $route = $this->route()->getName();
        if ($route == 'user.profile'){
            $id = Auth::user()->id;
            return [
                'name' => 'required|string:max;80',
                'email' => "required|string:max;80|unique:users,email,$id",
                'phone' => "required|unique:users,phone,$id",
                'birthday' => 'required|date_format:d/m/Y',
                'gender' => 'sometimes|nullable|in:1,2'
            ];
        }elseif ($route == 'user.password'){
            return [
                'old_password' => 'required',
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password',
            ];
        }

    }
}
