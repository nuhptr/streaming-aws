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

    // coloumn that can be filled
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'avatar',
        'role',
    ];

    // when get user data this field will be hidden
    protected $hidden = [
        'password',
    ];

    // casts data type
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
