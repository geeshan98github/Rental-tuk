<?php

namespace Database\Seeders;

use App\Models\ServiceFee;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServiceFeeSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'service' => 'Driver',
                'price' => '10',
            ],
            [
                'service' => 'Driving Instructor',
                'price' => '20',
            ],
            [
                'service' => 'Tour Guide',
                'price' => '30',
            ],
            [
                'service' => 'We can assist with obtaining your temporary Sri Lankan driving permit. (Requires your international driving permit and typically 1 business day).',
                'price' => '50',
            ],
            [
                'service' => 'Driving Instructor (Additional Session)',
                'price' => '30',
            ],
            [
                'service' => 'Baby seat',
                'price' => '50',
            ],
            [
                'service' => 'Big Bluetooth Speakers',
                'price' => '10',
            ],
            [
                'service' => 'Request a tuk-tuk with factory-fitted seatbelts (if available, $1/day extra)',
                'price' => '12',
            ],
            [
                'service' => 'Cooler / Esky',
                'price' => '40',
            ],
        ];

        foreach ($services as $service) {
            ServiceFee::create($service);
        }
    }
}