<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // ✅ REQUIRED FOR JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // ✅ REQUIRED FOR JWT
    public function getJWTCustomClaims()
    {
        return [];
    }
}