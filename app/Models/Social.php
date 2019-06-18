<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = [
        'user_id', 'provider_user_id', 'provider', 'avatar'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->select(['id', 'name', 'phone', 'email', 'birthday', 'activated_phone', 'activated', 'baned']);
    }
}
