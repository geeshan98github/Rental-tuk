<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VehicleDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehicle_details')->insert([
            [
                'type_id' => 1,
                'branch_id' => 1,
                'vehicle_number' => 'CAB-1234',
                'thumbnail' => 'vehicles/car1.jpg',
                'status' => 'Y',
                'is_delete' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type_id' => 2,
                'branch_id' => 2,
                'vehicle_number' => 'CAR-5678',
                'thumbnail' => 'vehicles/suv1.jpg',
                'status' => 'Y',
                'is_delete' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type_id' => 3,
                'branch_id' => 1,
                'vehicle_number' => 'VAN-9012',
                'thumbnail' => 'vehicles/van1.jpg',
                'status' => 'Y',
                'is_delete' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}