<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Permission extends BaseModel
{
    public $timestamps = false;
    use HasFactory;
    protected $guarded = [];

    // scopes

    public function scopeSearch($query , $q)
    {
        $query->where('name' , 'like' , "%$q%")
            ->orWhere('guard_name' , 'like' , "%$q%");
    }
}
