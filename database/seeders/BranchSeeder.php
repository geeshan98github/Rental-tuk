<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_branches')->insert([
            [
                'name' => 'Colombo Branch',
                'status' => 'Y',
                'is_delete' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kandy Branch',
                'status' => 'Y',
                'is_delete' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Galle Branch',
                'status' => 'Y',
                'is_delete' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}