<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable 
{
    use HasFactory, Notifiable;

    protected $guard = 'admin'; 

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_verified'
    ];

    protected $hidden = [
        'password',
    ];
    
    /**
     * Automatically hash the password when setting it.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
