<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopePaginateAndSearchAndOrder($q)
    {
        return $q
            ->search(request('q'))
            ->order(request('sort_by'), request('order'))
            ->paginate(30);
    }

    public function scopeSearch($q, $keyword)
    {
        return $q->where('name', 'like', "%{$keyword}%");
    }

    public function scopeOrder($q, $sort_by, $order)
    {
        return $q
            ->when($sort_by, function ($q) use ($sort_by, $order) {
                $q->orderby($sort_by, $order == "descending" ? "desc" : "asc");
            });
    }
}
