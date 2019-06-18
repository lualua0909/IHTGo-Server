<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_role';

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'role_id'
    ];

    public function role()
    {
        return $this->hasMany(Role::class, 'id', 'role_id');
    }
}
