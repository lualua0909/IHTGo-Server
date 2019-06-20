<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'url', 'read', 'content', 'type', 'to_id'
    ];

    //protected $dates = ['read'];

    public $timestamps = false;
}
