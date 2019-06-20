<?php

namespace App\Rules;

use App\Helpers\Business;
use App\User;
use Illuminate\Contracts\Validation\Rule;

class CheckAccountCustomerExists implements Rule
{
    private $attr;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->attr = $attribute;
        $user = User::where([$attribute => $value])->where(['level' => Business::USER_LEVEL_CUSTOMER])->count();
        return !$user;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Thông tin ' . $this->handleAttributeName() . ' đã được đăng kí.';
    }

    private function handleAttributeName()
    {
        switch ($this->attr){
            case 'phone':
                return __('phone');
                break;
            case 'email':
                return __('email');
                break;
            default :
                return __('undefined');
                break;
        }
    }

}
