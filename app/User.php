<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Laravelista\Comments\Commenter;

class User extends Authenticatable
{
    use Notifiable, HasRoles, Commenter;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cover', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // public function role()
    // {
    //     return $this->belongsTo('App\Role');
    // }


    public function setCoverAttribute($cover)
    {
        $this->attributes['cover'] = str_replace("http://localhost:8000", "", $cover);
    }



    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // public function isAdmin()
    // {
    //     if ($this->role->name == 'Administrator' && $this->is_active == 1) {

    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
