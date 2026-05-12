<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [['name' => 'Colombo'], ['name' => 'Kandy'], ['name' => 'Galle'], ['name' => 'Jaffna'], ['name' => 'Negombo'], ['name' => 'Trincomalee'], ['name' => 'Batticaloa'], ['name' => 'Ratnapura'], ['name' => 'Kurunegala'], ['name' => 'Anuradhapura']];

        DB::table('tbl_city')->insert($cities);
    }
}