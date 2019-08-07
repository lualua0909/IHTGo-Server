<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 8/4/2018
 * Time: 5:31 PM
 */

namespace App\Http\Resources;


class UserResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'chatkit_id' => $this->chatkit_id
        ];
    }
}