<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $casts = [
        'content' => 'array'
    ];

    protected $fillable = [
      'content', 'created'
    ];

    public $timestamps = false;
}
