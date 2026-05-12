<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    protected $table = 'tbl_countries';
    public $timestamps = true;


    protected $fillable = [
        'printable_name',
        'printable_name_si',
        'printable_name_ta',
        'status',
        'is_delete',
    ];
}
