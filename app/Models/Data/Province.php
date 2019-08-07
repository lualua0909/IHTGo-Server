<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
      'name', 'province_id', 'publish'
    ];

    public $timestamps = false;

}
