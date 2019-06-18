<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'role_permission';
    protected $fillable = [
        'role_id', 'permission_id'
    ];

    public $timestamps = false;
}
