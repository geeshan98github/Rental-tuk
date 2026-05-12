<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [['name' => 'Sri Lanka'], ['name' => 'India'], ['name' => 'United States'], ['name' => 'United Kingdom'], ['name' => 'Australia'], ['name' => 'Canada'], ['name' => 'Germany'], ['name' => 'France'], ['name' => 'Japan'], ['name' => 'China']];

        DB::table('tbl_countries')->insert($countries);
    }
}