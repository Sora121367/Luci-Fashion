<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'Firstname',
        'Lastname',
        'phonenumber',
        'city',
        'email',
        'password',
        'verification_code',
        'reset_code',
        'gender',
        'google_id',
        'role',
        'is_verified',
    ];

    public function getNameAttribute()
{
    return trim("{$this->Firstname} {$this->Lastname}");
}


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_verified' => 'boolean',
    ];
   
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }
}
