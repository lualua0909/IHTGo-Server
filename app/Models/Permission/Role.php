<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission')->select('id');
    }

    public function users()
    {
        return $this->hasMany(UserRole::class)->select('name', 'id');
    }
}
