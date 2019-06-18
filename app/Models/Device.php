<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'user_id','fcm','device_id','device_name','os','app_version'
    ];
}
