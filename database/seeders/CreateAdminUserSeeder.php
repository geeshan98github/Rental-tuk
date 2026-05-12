<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@tuktuk.net',
            'password' => bcrypt('Tek@2023')
        ]);

        $role = Role::create(['name' => 'Admin', 'guard_name' => 'web']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        // $user->assignRole([$role->id]);
        $user->assignRole('Admin');
    }
}
