<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehicle_types')->insert([
            [
                'name' => 'Sedan Car',
                'rate_per_day' => '15000',
                'deposit_price' => '50000',
                'status' => 'Y',
                'is_delete' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'SUV',
                'rate_per_day' => '25000',
                'deposit_price' => '75000',
                'status' => 'Y',
                'is_delete' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Van',
                'rate_per_day' => '30000',
                'deposit_price' => '100000',
                'status' => 'Y',
                'is_delete' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}