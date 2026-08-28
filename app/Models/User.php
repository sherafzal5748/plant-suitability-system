<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded=[];

    protected $hidden=[
        'password',
        'remember_token'
    ];

    public function whitelists()
    {
        return $this->hasMany(Whitelist::class);
    }

    // Model fix if $this->image already contains 'avatars/photo.jpg'
    public function getProfileImageAttribute()
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('storage/avatars/default.png');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
}