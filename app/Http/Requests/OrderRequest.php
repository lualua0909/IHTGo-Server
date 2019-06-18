<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'car_type' => 'required|exists:others,id',
            'total_price' => 'required',
            'payment_type' => 'sometimes|nullable|in:1,2,3',
            'car_option' => 'sometimes|nullable|in:1,2,3',
            'sender_name' => 'required',
            'sender_phone' => 'required',
            'sender_address' => 'required',
            'sender_date' => 'sometimes|nullable|date_format:d/m/Y' ,
            'receive_name' => 'required',
            'receive_phone' => 'required',
            'receive_address' => 'required',
            'receive_date' => 'sometimes|nullable|date_format:d/m/Y',
            'sender_province_id' => 'required',
            'sender_district_id' => 'required',
            'receive_province_id' => 'required',
            'receive_district_id' => 'required',
            'coupon_code' => 'sometimes|nullable|unique:orders,coupon_code'
        ];
    }
}
