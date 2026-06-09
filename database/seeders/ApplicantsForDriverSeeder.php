<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApplicantsForDriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert Drivers
        DB::table('applicants_for_driver')->insert([
            [
                'id' => 1,
                'city_id' => 1,
                'first_name' => 'Kamal',
                'last_name' => 'Perera',
                'email' => 'kamal@example.com',
                'phone_number' => '0771234567',
                'address' => 'Colombo, Sri Lanka',
                'license_number' => 'B1234567',
                'year_of_experience' => 5,
                'spoken_languages' => 'Sinhala, English',
                'license_image' => 'licenses/kamal_license.jpg',
                'police_report' => 'reports/kamal_police.pdf',
                'approve_status' => 'approved',
                'availability' => 'Y',
                'status' => 'Y',
                'is_delete' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'city_id' => 2,
                'first_name' => 'Nimal',
                'last_name' => 'Silva',
                'email' => 'nimal@example.com',
                'phone_number' => '0719876543',
                'address' => 'Galle, Sri Lanka',
                'license_number' => 'C9876543',
                'year_of_experience' => 8,
                'spoken_languages' => 'Sinhala, Tamil',
                'license_image' => 'licenses/nimal_license.jpg',
                'police_report' => 'reports/nimal_police.pdf',
                'approve_status' => 'pending',
                'availability' => 'Y',
                'status' => 'Y',
                'is_delete' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'city_id' => 3,
                'first_name' => 'Ruwan',
                'last_name' => 'Fernando',
                'email' => 'ruwan@example.com',
                'phone_number' => '0754567890',
                'address' => 'Kandy, Sri Lanka',
                'license_number' => 'D4567890',
                'year_of_experience' => 3,
                'spoken_languages' => 'English',
                'license_image' => 'licenses/ruwan_license.jpg',
                'police_report' => 'reports/ruwan_police.pdf',
                'approve_status' => 'rejected',
                'availability' => 'N',
                'status' => 'Y',
                'is_delete' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Create User Accounts only for Approved Drivers
        $approvedDrivers = DB::table('applicants_for_driver')->where('approve_status', 'approved')->get();

        foreach ($approvedDrivers as $driver) {
            $user = User::create([
                'name' => $driver->first_name . ' ' . $driver->last_name,
                'branch_id' => null,
                'email' => $driver->email,
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $user->assignRole('Drivers');
        }
    }
}