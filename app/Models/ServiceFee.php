<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceFee extends Model
{
     use HasFactory;

    protected $table = 'service_fees';
    public $timestamps = true;

    protected $fillable = [
        'service',
        'price',
       
    ];
}