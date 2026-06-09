<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bookings')->insert([
            [
                'trip_id' => 1,
                'check_in' => '2026-06-01',
                'pickup_time' => '08:00:00',
                'pickup_location' => 1,
                'check_out' => '2026-06-05',
                'return_time' => '06:00:00',
                'return_location' => 2,
                'trip_duration' => 4,
                'vehicle_id' => 1,
                'extras_total' => 50,
                'sub_total' => 400,
                'grand_total' => 450,

                'driver_requesting' => 'yes',
                'driver_first_lang' => 'English',
                'driver_second_lang' => 'Sinhala',

                'instructor_requesting' => 'yes',
                'instructor_first_lang' => null,
                'instructor_second_lang' => null,

                'guide_requesting' => 'yes',
                'guide_first_lang' => 'English',
                'guide_second_lang' => 'Tamil',

                'local_license' => 'yes',
                'local_license_qty' => 1,

                'instructor_additional_session' => 'no',
                'instructor_additional_session_qty' => 0,

                'baby_seat' => 'yes',
                'baby_seat_qty' => 1,

                'bluetooth_speakers' => 'yes',
                'bluetooth_speakers_qty' => 1,

                'tuktuk_with_seatbelts' => 'no',
                'tuktuk_with_seatbelts_qty' => 0,

                'cooler' => 'yes',
                'cooler_qty' => 1,

                'passenger_id' => 1,

                'payment_status' => 'Paid',
                'booking_status' => 'Pending',
                'trip_status' => 'Pending',

                'driver_id' => null,
                'instructor_id' => null,
                'mechanic_id' => null,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'trip_id' => 2,
                'check_in' => '2026-06-10',
                'pickup_time' => '09:30:00',
                'pickup_location' => 2,
                'check_out' => '2026-06-15',
                'return_time' => '05:30:00',
                'return_location' => 1,
                'trip_duration' => 5,
                'vehicle_id' => 2,
                'extras_total' => 30,
                'sub_total' => 500,
                'grand_total' => 530,

                'driver_requesting' => 'yes',
                'driver_first_lang' => 'English',
                'driver_second_lang' => 'Tamil',

                'instructor_requesting' => 'yes',
                'instructor_first_lang' => 'English',
                'instructor_second_lang' => 'Sinhala',

                'guide_requesting' => 'no',
                'guide_first_lang' => null,
                'guide_second_lang' => null,

                'local_license' => 'yes',
                'local_license_qty' => 1,

                'instructor_additional_session' => 'yes',
                'instructor_additional_session_qty' => 2,

                'baby_seat' => 'no',
                'baby_seat_qty' => 0,

                'bluetooth_speakers' => 'no',
                'bluetooth_speakers_qty' => 0,

                'tuktuk_with_seatbelts' => 'yes',
                'tuktuk_with_seatbelts_qty' => 1,

                'cooler' => 'no',
                'cooler_qty' => 0,

                'passenger_id' => 2,

                'payment_status' => 'Pending',
                'booking_status' => 'Pending',
                'trip_status' => 'Pending',

                'driver_id' => 1,
                'instructor_id' => 1,
                'mechanic_id' => null,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'trip_id' => 3,
                'check_in' => '2026-07-01',
                'pickup_time' => '07:00:00',
                'pickup_location' => 2,
                'check_out' => '2026-07-03',
                'return_time' => '04:00:00',
                'return_location' => 2,
                'trip_duration' => 2,
                'vehicle_id' => 3,
                'extras_total' => 20,
                'sub_total' => 250,
                'grand_total' => 270,

                'driver_requesting' => 'no',
                'driver_first_lang' => null,
                'driver_second_lang' => null,

                'instructor_requesting' => 'no',
                'instructor_first_lang' => null,
                'instructor_second_lang' => null,

                'guide_requesting' => 'yes',
                'guide_first_lang' => 'English',
                'guide_second_lang' => 'French',

                'local_license' => 'no',
                'local_license_qty' => 0,

                'instructor_additional_session' => 'no',
                'instructor_additional_session_qty' => 0,

                'baby_seat' => 'yes',
                'baby_seat_qty' => 2,

                'bluetooth_speakers' => 'yes',
                'bluetooth_speakers_qty' => 1,

                'tuktuk_with_seatbelts' => 'yes',
                'tuktuk_with_seatbelts_qty' => 1,

                'cooler' => 'yes',
                'cooler_qty' => 1,

                'passenger_id' => 3,

                'payment_status' => 'Paid',
                'booking_status' => 'Pending',
                'trip_status' => 'Pending',

                'driver_id' => null,
                'instructor_id' => null,
                'mechanic_id' => null,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}