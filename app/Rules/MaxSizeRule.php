<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxSizeRule implements Rule
{
    public $maxSize;

    /**
     * MaxSizeRule constructor.
     * @param $maxSize
     */
    public function __construct($maxSize)
    {
        $this->maxSize = $maxSize;
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
        $size = 0;
        dd($size);
        foreach (request()->$attribute as $item){
            $size .= $item->getClientSize();
        }
        return ($size <= $this->maxSize);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tổng file upload phải bé hơn ' . $this->maxSize . ' Kilobyte';
    }
}
