<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mechanic extends Model
{
    use HasFactory;
    protected $table = 'applicants_for_mechanic';
    public $timestamps = true;

    protected $fillable = ['first_name', 'user_id','last_name', 'email', 'phone_number', 'address', 'certificates', 'skills', 'nic_image', 'police_report', 'status','approve_status', 'is_delete','year_of_experience', 'city_id', ];
}