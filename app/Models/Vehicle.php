<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicle_details';
    public $timestamps = true;

    protected $fillable = [
        'type_id',
        'branch_id',
        'vehicle_number',
        'thumbnail',
        'status',
        'is_delete',
    ];

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'type_id');
    }
}