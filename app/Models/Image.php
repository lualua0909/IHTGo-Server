<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
      'position', 'path', 'filename', 'type', 'service_id'
    ];

    public $timestamps = false;
}
