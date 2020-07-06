<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'username','name', 'lastname', 'email', 'password', 'permissions', 'avatar'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles(){
        return $this->hasMany(Article::class);
    }
    
        public function scopeSearch($query, $searchTerm)
    {
        return $query
            ->where('username', 'like', "%" . $searchTerm . "%")
            ->orWhere('name', 'like', "%" . $searchTerm . "%")
            ->orWhere('lastname', 'like', "%" . $searchTerm . "%")
            ->orWhereRaw("concat(name, ' ', lastname) like '%$searchTerm%' ")
            ->orWhere('email', 'like', "%" . $searchTerm . "%");
    }

}
