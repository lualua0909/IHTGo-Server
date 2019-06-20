<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'user_id', 'fcm', 'device_id', 'device_name', 'os', 'app_version'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
