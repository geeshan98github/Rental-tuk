<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class PassengerUser extends Authenticatable
{
    use Notifiable;
    protected $guard_name = 'frontend';

   

    protected $fillable = [
        'first_name', 'last_name', 'phone_number', 'email', 'password','contry_of_residence',
        'is_email_verified','verification_code', 'email_verified_at','profile_image',
         'date_of_birth', 'age', 'passport_number', 'emergency_number','license_image','passport_image'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
