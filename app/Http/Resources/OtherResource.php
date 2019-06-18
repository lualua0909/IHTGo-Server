<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 2/7/2018
 * Time: 2:42 PM
 */

namespace App\Http\Resources;


class OtherResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'name' => $this->name
        ];
    }
}