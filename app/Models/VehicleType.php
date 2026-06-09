<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleType extends Model
{
    use HasFactory;

    protected $table = 'vehicle_types';
    public $timestamps = true;

    protected $fillable = ['name', 'rate_per_day', 'deposit_price','status','is_delete'];

    public function vehicle()
    {
        return $this->hasMany(Vehicle::class, 'type_id');
    }
}