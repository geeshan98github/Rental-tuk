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
use Illuminate\Support\Str;

class ApplicantsForInstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructors = [
            [
                'city_id' => 1,
                'first_name' => 'Kasun',
                'last_name' => 'Perera',
                'email' => 'kasun.perera@example.com',
                'phone_number' => '0771234567',
                'address' => 'Colombo, Sri Lanka',
                'license_number' => 'B1234567',
                'year_of_experience' => 5,
                'spoken_languages' => 'Sinhala, English',
                'license_image' => 'licenses/kasun-license.jpg',
                'police_report' => 'reports/kasun-report.pdf',
                'approve_status' => 'approved',
                'availability' => 'Y',
                'status' => 'Y',
                'is_delete' => 0,
            ],

            [
                'city_id' => 2,
                'first_name' => 'Nadeesha',
                'last_name' => 'Fernando',
                'email' => 'nadeesha.fernando@example.com',
                'phone_number' => '0719876543',
                'address' => 'Kandy, Sri Lanka',
                'license_number' => 'C9876543',
                'year_of_experience' => 3,
                'spoken_languages' => 'Sinhala, Tamil',
                'license_image' => 'licenses/nadeesha-license.jpg',
                'police_report' => 'reports/nadeesha-report.pdf',
                'approve_status' => 'pending',
                'availability' => 'Y',
                'status' => 'Y',
                'is_delete' => 0,
            ],

            [
                'city_id' => 3,
                'first_name' => 'Ahmed',
                'last_name' => 'Rizwan',
                'email' => 'ahmed.rizwan@example.com',
                'phone_number' => '0754567890',
                'address' => 'Galle, Sri Lanka',
                'license_number' => 'D4567890',
                'year_of_experience' => 7,
                'spoken_languages' => 'English, Tamil',
                'license_image' => 'licenses/ahmed-license.jpg',
                'police_report' => 'reports/ahmed-report.pdf',
                'approve_status' => 'approved',
                'availability' => 'N',
                'status' => 'Y',
                'is_delete' => 0,
            ],
        ];

        foreach ($instructors as $instructor) {
            // Insert instructor
            $instructorId = DB::table('applicants_for_instructor')->insertGetId([
                'city_id' => $instructor['city_id'],
                'first_name' => $instructor['first_name'],
                'last_name' => $instructor['last_name'],
                'email' => $instructor['email'],
                'phone_number' => $instructor['phone_number'],
                'address' => $instructor['address'],
                'license_number' => $instructor['license_number'],
                'year_of_experience' => $instructor['year_of_experience'],
                'spoken_languages' => $instructor['spoken_languages'],
                'license_image' => $instructor['license_image'],
                'police_report' => $instructor['police_report'],
                'approve_status' => $instructor['approve_status'],
                'availability' => $instructor['availability'],
                'status' => $instructor['status'],
                'is_delete' => $instructor['is_delete'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Create user account only for approved instructors
            if ($instructor['approve_status'] == 'approved') {
               $user = User::create([
                    'name' => $instructor['first_name'] . ' ' . $instructor['last_name'],
                    'branch_id' => null,
                    'email' => $instructor['email'],
                    'email_verified_at' => Carbon::now(),
                    'password' => Hash::make('12345678'),
                    'remember_token' => Str::random(10),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);


                $user->assignRole('Instructors');
            }
        }
    }
}