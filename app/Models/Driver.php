<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory;
    protected $table = 'applicants_for_driver';
    public $timestamps = true;


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'address',
        'license_number',
        'year_of_experience',
        'vehical_reg_number',
        'spoken_languages',
        'license_image',
        'police_report',
        'approve_status',
        'status',
        'is_delete',
    ];
}
