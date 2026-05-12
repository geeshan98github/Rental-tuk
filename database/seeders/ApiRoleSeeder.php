<?php

namespace Database\Seeders;

use App\Models\ApiRole;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApiRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ApiRole::create(['name' => 'admin']);
        ApiRole::create(['name' => 'paid']);
        ApiRole::create(['name' => 'free']);

    }
}
