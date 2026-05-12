<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateDynamicMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menu = [
            [
                'id' => 1,
                'icon' => 'fal fa-lg fa-fw fa-chart-pie',
                'title' => 'Dashboard',
                'page_id' => 1,
                'url' => 'adminpanel/dashboard',
                'parent_id' => 1,
                'is_parent' => 1,
                'show_menu' => 1,
                'parent_order' => 1,
                'child_order' => 1,
                'fOrder' => 1.0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'icon' => 'fal fa-lg fa-fw fa-user',
                'title' => 'Admin',
                'page_id' => 2,
                'url' => '#',
                'parent_id' => 0,
                'is_parent' => 1,
                'show_menu' => 1,
                'parent_order' => 20,
                'child_order' => 0,
                'fOrder' => 2.0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'icon' => '',
                'title' => 'User',
                'page_id' => 3,
                'url' => 'adminpanel/user-list',
                'parent_id' => 2,
                'is_parent' => 0,
                'show_menu' => 1,
                'parent_order' => null,
                'child_order' => 1,
                'fOrder' => 2.01,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'icon' => '',
                'title' => 'Role',
                'page_id' => 4,
                'url' => 'adminpanel/role-list',
                'parent_id' => 2,
                'is_parent' => 0,
                'show_menu' => 1,
                'parent_order' => null,
                'child_order' => 2,
                'fOrder' => 2.02,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 5,
                'icon' => '',
                'title' => 'Logs',
                'page_id' => 5,
                'url' => 'adminpanel/log-activity-list',
                'parent_id' => 2,
                'is_parent' => 0,
                'show_menu' => 1,
                'parent_order' => null,
                'child_order' => 3,
                'fOrder' => 2.03,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
             [
                'id' =>10,
                'icon' => 'fal fa-lg fa-fw fa-user',
                'title' => 'Job Applicants',
                'page_id' => 10,
                'url' => '#',
                'parent_id' => 0,
                'is_parent' => 1,
                'show_menu' => 1,
                'parent_order' => 2,
                'child_order' => 0,
                'fOrder' => 10.0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 11,
                'icon' => '',
                'title' => 'Driver Applicants',
                'page_id' => 11,
                'url' => 'adminpanel/driver-applicant-list',
                'parent_id' => 10,
                'is_parent' => 0,
                'show_menu' => 1,
                'parent_order' => null,
                'child_order' => 1,
                'fOrder' => 10.01,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
             [
                'id' => 12,
                'icon' => '',
                'title' => 'Mechanic Applicants',
                'page_id' => 12,
                'url' => 'adminpanel/mechanic-applicant-list',
                'parent_id' => 10,
                'is_parent' => 0,
                'show_menu' => 1,
                'parent_order' => null,
                'child_order' => 2,
                'fOrder' => 10.02,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 13,
                'icon' => '',
                'title' => 'Instructor Applicants',
                'page_id' => 13,
                'url' => 'adminpanel/instructor-applicant-list',
                'parent_id' => 10,
                'is_parent' => 0,
                'show_menu' => 1,
                'parent_order' => null,
                'child_order' => 3,
                'fOrder' => 10.03,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($menu as $item) {
            DB::table('dynamic_menu')->updateOrInsert(
                ['id' => $item['id']], // Match by `id`
                [
                    'icon' => $item['icon'],
                    'title' => $item['title'],
                    'page_id' => $item['page_id'],
                    'url' => $item['url'],
                    'parent_id' => $item['parent_id'],
                    'is_parent' => $item['is_parent'],
                    'show_menu' => $item['show_menu'],
                    'parent_order' => $item['parent_order'],
                    'child_order' => $item['child_order'],
                    'fOrder' => $item['fOrder'],
                    'updated_at' => now(), // Update `updated_at` always
                ],
            );
        }
    }
}
