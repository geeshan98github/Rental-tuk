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

            'branches-list',
            'branches-create',
            'branches-edit',
            'branches-delete',

            'cities-list',
            'cities-create',
            'cities-edit',
            'cities-delete',

            
            'vehicle-type-list',
            'vehicle-type-create',
            'vehicle-type-edit',
            'vehicle-type-delete',

            'vehicle-list',
            'vehicle-create',
            'vehicle-edit',
            'vehicle-delete',

            
            'service-fee-list',
            'service-fee-create',
            'service-fee-edit',
            'service-fee-delete',


            'approved-driver-list',
            'approved-mechanic-list',
            'approved-instructor-list',
            'new-booking-list',
            'accepted-booking-list',
            
            
            'driver-availability-calendar',
            'new-trip-request-list',
            'ongoing-trip-list',
            'completed-trip-list',

            'instructor-availability-calendar',
            'new-driving-session-request-list', 
            'completed-driving-session-list'
            
           
           
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

            '21',
            '21',
            '21',
            '21',

            '22',
            '22',
            '22',
            '22',


            '23',
            '23',
            '23',
            '23',

            '24',
            '24',
            '24',
            '24',

            '25',
            '25',
            '25',
            '25',
            

            
            '31',
            '32',
            '33',
            '34',
            '35',


            '61',
            '62',
            '63',
            '64',

            '71',
            '72', 
            '73',  
        
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