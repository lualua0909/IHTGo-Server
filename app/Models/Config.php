<?php

namespace App\Models;

class Config extends BaseModel
{
    protected $fillable = [
        'name', 'value', 'created_by', 'created_at', 'updated_by', 'updated_at'
    ];
}
