<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'tbl_city';
    public $timestamps = true;


    protected $fillable = [
        'city_en',
        'city_si',
        'city_ta',
        'status',
        'is_delete',
        'postal_id'
    ];

}
