<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApppLog extends Model
{
    use HasFactory;

    protected $table = 'appp_logs';
    public $timestamps = true;

    protected $fillable = [
        'appp_id',
        'appp_item_id',
        'status',
        'status_description',
        'remark',
        'user_id',
    ];

}
