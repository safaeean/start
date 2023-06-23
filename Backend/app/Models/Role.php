<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Role extends BaseModel
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    // relations

    function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
    }

    // scopes

    public function scopeSearch($query , $q)
    {
        $query->where('name' , 'like' , "%$q%")
            ->orWhere('guard_name' , 'like' , "%$q%");
    }
}
