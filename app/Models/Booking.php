<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
     use HasFactory;
    protected $table = 'bookings';
    public $timestamps = true;


    protected $fillable = [
        'trip_id',
        'check_in',
        'pickup_time',
        'pickup_location',
        'check_out',
        'return_time',
        'return_location',
        'trip_duration',
        'vehicle_id',
        'extras_total',
        'sub_total',
        'grand_total',
        'driver_requesting',
        'driver_first_lang',
        'driver_second_lang',
        'instructor_requesting',
        'instructor_first_lang',
        'instructor_second_lang',
        'guide_requesting',
        'guide_first_lang',
        'guide_second_lang',
        'local_license',
        'local_license_qty', 
        'instructor_additional_session',
        'instructor_additional_session_qty',
        'baby_seat',
        'baby_seat_qty',
        'bluetooth_speakers',
        'bluetooth_speakers_qty',
        'tuktuk_with_seatbelts',
        'tuktuk_with_seatbelts_qty',
        'cooler',
        'cooler_qty',
        'passenger_id',
        'payment_status',

        
    ];
}
