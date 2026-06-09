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
       

        $roles = ['Admin', 'Branch Manager', 'Drivers', 'Instructors', 'Mechanic'];

        $permissions = Permission::all();

        foreach ($roles as $roleName) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);

            $role->syncPermissions($permissions);
        }

        // Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@tuktuk.net'],
            [
                'name' => 'Admin',
                'password' => bcrypt('Tek@2023'),
            ],
        );

        $admin->assignRole('Admin');

        // Create Branch Manager User
        $branchManager = User::firstOrCreate(
            ['email' => 'branchmanager@tuktuk.net'],
            [
                'name' => 'Branch Manager',
                'password' => bcrypt('Tek@2023'),
                'branch_id' => 1,
            ],
        );

        $branchManager->assignRole('Branch Manager');
    }
}