<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Page extends BaseModel
{
    use HasFactory;
    protected $fillable = ['title' , 'slug', 'description' , 'content' , 'active'];

    protected static function boot()
    {
        static::creating(function (self $page){
            $page->user_id = auth()->id();
            $page->slug = Str::slug($page->title);
        });
        parent::boot(); // TODO: Change the autogenerated stub
    }

    public function scopeSearch($query , $q)
    {
        $query->where('title' , 'like' , "%$q%")
            ->orWhere('description' , 'like' , "%$q%");
    }
}
