<?php

namespace Database\Seeders;

use App\Models\Resident;
use App\Services\ActivityLogService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogService $service)
    {
        $residents = array(
            [
                'id' => 1,
                'purok_id' => mt_rand(1,4),
                'first_name' => 'Test',
                'middle_name' => 'Cee',
                'last_name' => 'Resident', 
                'gender' => 'male',
                'birth_date' => '1998/01/01',
                'address' => 'Rizal St, Barangay San Gavino Victoria, Tarlac',
                'contact' => '09659312003',
                'civil_status' => 'single',
                'citizenship' => 'filipino',
                'is_voter' => mt_rand(1,2),
                'created_at' => now()
            ],
            [
                'id' => 2,
                'purok_id' => mt_rand(1,4),
                'first_name' => 'Abbeygale Marie ',
                'middle_name' => 'Cee',
                'last_name' => 'Paradero', 
                'gender' => 'male',
                'birth_date' => '1998/01/01',
                'address' => 'Rizal St, Barangay San Gavino Victoria, Tarlac',
                'contact' => '09459820496',
                'civil_status' => 'single',
                'citizenship' => 'filipino',
                'is_voter' => mt_rand(1,2),
                'created_at' => now()
            ],
            [
                'id' => 3,
                'purok_id' => mt_rand(1,4),
                'first_name' => 'Chloe Anne',
                'middle_name' => 'Cee',
                'last_name' => 'Verlice', 
                'gender' => 'male',
                'birth_date' => '1998/01/01',
                'address' => 'Rizal St, Barangay San Gavino Victoria, Tarlac',
                'contact' => '09459820496',
                'civil_status' => 'single',
                'citizenship' => 'filipino',
                'is_voter' => mt_rand(1,2),
                'created_at' => now()
            ],
            // [
            //     'id' => 2,
            //     'purok_id' => mt_rand(1,4),
            //     'first_name' => 'Adriane',
            //     'middle_name' => 'A',
            //     'last_name' => 'Deleon', 
            //     'gender' => 'male',
            //     'birth_date' => '2000/01/01',
            //     'address' => 'Rizal St, Barangay San Gavino Victoria, Tarlac',
            //     'contact' => '09656913539',
            //     'civil_status' => 'single',
            //     'citizenship' => 'filipino',

            //     'is_voter' => mt_rand(1,2),
            //     'created_at' => now()
            // ],
            // [
            //     'id' => 3,
            //     'purok_id' => mt_rand(1,4),
            //     'first_name' => 'Kagawad',
            //     'middle_name' => 'C',
            //     'last_name' => 'Domiong', 
            //     'gender' => 'male',
            //     'birth_date' => '2000/01/01',
            //     'address' => 'Rizal St, Barangay San Gavino Victoria, Tarlac',
            //     'contact' => '09165030470',
            //     'civil_status' => 'single',
            //     'citizenship' => 'filipino',
            //     'is_voter' => mt_rand(1,2),
            //     'created_at' => now()
            // ],
            // [
            //     'id' => 4,
            //     'purok_id' => mt_rand(1,4),
            //     'first_name' => 'Shariah',
            //     'middle_name' => 'C',
            //     'last_name' => 'Manzano', 
            //     'gender' => 'female',
            //     'birth_date' => '2000/01/01',
            //     'address' => 'Rizal St, Barangay San Gavino Victoria, Tarlac',
            //     'contact' => '09283707767',
            //     'civil_status' => 'single',
            //     'citizenship' => 'filipino',
            //     'is_voter' => mt_rand(1,2),
            //     'created_at' => now()
            // ],
        );

        Resident::insert($residents);

        Resident::all()->map(fn(
            $resident) => $service->log_activity(model:$resident, event:'added', model_name: 'Resident', model_property_name: $resident->full_name)
        );
    }
}