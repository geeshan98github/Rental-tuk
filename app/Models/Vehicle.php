<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehical_details';
    public $timestamps = true;

    protected $fillable = [
        'vehical_type',
        'rate_per_day',
        'deposit_price',
        'vehical_number'
    ];
}
