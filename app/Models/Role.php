<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'guard_name',
    ];

    public function users()
    {
        return $this->hasMany('App\User', 'id', 'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'role_has_permissions');
    }
}
