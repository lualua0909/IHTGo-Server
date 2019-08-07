<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
      'name', 'province_id', 'publish', 'type', 'publish_2'
    ];

    public $timestamps = false;
}
