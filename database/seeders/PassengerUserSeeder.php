<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PassengerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('passenger_users')->insert([
            [
                'first_name' => 'John',
                'last_name' => 'Smith',
                'phone_number' => '94771234567',
                'profile_image' => null,
                'date_of_birth' => '1995-05-10',
                'age' => 30,
                'passport_number' => 'N1234567',
                'emergency_number' => '94770000001',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'contry_of_residence' => 'United Kingdom',
                'is_email_verified' => 'Y',
                'verification_code' => null,
                'passport_image' => null,
                'license_image' => null,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'first_name' => 'Emma',
                'last_name' => 'Wilson',
                'phone_number' => '94771234568',
                'profile_image' => null,
                'date_of_birth' => '1998-08-15',
                'age' => 27,
                'passport_number' => 'P9876543',
                'emergency_number' => '94770000002',
                'email' => 'emma@example.com',
                'password' => Hash::make('password'),
                'contry_of_residence' => 'Australia',
                'is_email_verified' => 'Y',
                'verification_code' => null,
                'passport_image' => null,
                'license_image' => null,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'first_name' => 'David',
                'last_name' => 'Brown',
                'phone_number' => '94771234569',
                'profile_image' => null,
                'date_of_birth' => '1992-11-20',
                'age' => 33,
                'passport_number' => 'L4567890',
                'emergency_number' => '94770000003',
                'email' => 'david@example.com',
                'password' => Hash::make('password'),
                'contry_of_residence' => 'Canada',
                'is_email_verified' => 'Y',
                'verification_code' => null,
                'passport_image' => null,
                'license_image' => null,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}