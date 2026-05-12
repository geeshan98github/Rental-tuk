<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $permissions = [
            'dashboard',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'log-activity-list',

            'driver-applicant-list',
            'send-approvel-driver-applicant',
            'action-driver-applicant',
            'mechanic-applicant-list',
            'send-approvel-mechanic-applicant',
            'action-mechanic-applicant',
            'instructor-applicant-list',
            'action-instructor-applicant',
            'send-approvel-instructor-applicant',

           
           
        ];
        $dynamicID = [
            '1',
            '4',
            '4',
            '4',
            '4',
            '3',
            '3',
            '3',
            '3',
            '5',

            '11',
            '11',
            '11',
            '12',
            '12',
            '12',
            '13',
            '13',
            '13',
        
        ];

        for ($i = 0; $i < count($permissions); $i++) {
            Permission::updateOrInsert(
                ['name' => $permissions[$i]], // Match by 'name'
                [
                    'dynamic_menu_id' => $dynamicID[$i],
                    'guard_name' => 'web',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    // If you have other fields to update, add them here
                ]
            );
        }

    }
}
