<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Services\ActivityLogService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogService $activity_log_service)
    {
        $services = array(
            [
                'id' => 1,
                'name' => 'Barangay Clearance',
                'description' => 'A requirement before the municipality issues any license for the business or activity.', 
                'fee' => 20, 
                'created_at' => now()
            ],

            [
                'id' => 2,
                'name' => 'Certificate of Indigency',
                'description' => "Issued to less fortunate resident who desires to avail assistance such as Scholarship, Medical Services, Free Legal Aid from Public Attorneys Office (PAO) and the like.", 
                'fee' => 20, 
                'created_at' => now()
            ],

            [
                'id' => 3,
                'name' => 'Certificate of Residency',
                'description' => 'This document certifies that you are a good resident in the barangay and have a good moral character.', 
                'fee' => 20, 
                'created_at' => now()
            ],

            [
                'id' => 4,
                'name' => 'Business Clearance/Permit',
                'description' => 'A form of licence that businesses must apply for and obtain through their local Barangay Office.', 
                'fee' => 20, 
                'created_at' => now()
            ],
        );

        Service::insert($services);

        Service::all()->map(fn(
            $service) => $activity_log_service->log_activity(model:$service, event:'added', model_name: 'Service', model_property_name: $service->name)
        );
    }
}