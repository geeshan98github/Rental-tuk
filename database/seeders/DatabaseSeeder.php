<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CreateDynamicMenuSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(ServiceFeeSeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(VehicleTypeSeeder::class);
        $this->call(VehicleDetailSeeder::class);
        $this->call(PassengerUserSeeder::class);
        $this->call(BookingSeeder::class);
        $this->call(ApplicantsForDriverSeeder::class);
        $this->call(ApplicantsForInstructorSeeder::class);
    }
}