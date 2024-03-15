<?php

namespace Database\Seeders;

use App\Models\Request;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requests = array(

            // barangay clearance
            [
                'id' => 1,
                'user_id' => 3,
                'service_id' => 1,
                'purpose' => 'Job Requirement',
                'business_name' => null,
                'business_type' => null,
                'business_location' => null,
                'residency_year' => null,
                'resident_type' => null,
                'status' => 0,
                'paypal_transaction_id' => '15F41997GB955064H',
                'created_at' => now()
            ],

            //Certificate of Indigency
            [
                'id' => 2,
                'user_id' => 4,
                'service_id' => 2,
                'purpose' => 'Job Requirement',
                'business_name' => null,
                'business_type' => null,
                'business_location' => null,
                'residency_year' => null,
                'resident_type' => null,
                'status' => 0,
                'paypal_transaction_id' => '15F41997GB955064J',
                'created_at' => now()
            ],

            //Certificate of Residency
            [
                'id' => 3,
                'user_id' => 5,
                'service_id' => 3,
                'purpose' => 'Job Requirement',
                'business_name' => null,
                'business_type' => null,
                'business_location' => null,
                'residency_year' => '15',
                'resident_type' => 'permanent resident',
                'status' => 0,
                'paypal_transaction_id' => '15F41997GB955064K',
                'created_at' => now()
            ],

            //Barangay Business Clearance
            [
                'id' => 4,
                'user_id' => 3,
                'service_id' => 4,
                'purpose' => 'Job Requirement',
                'business_name' => 'Test Halo-Halo',
                'business_type' => 'sole proprietorship',
                'business_location' => 'Victoria, Tarlac',
                'residency_year' => null,
                'resident_type' => null,
                'status' => 0,
                'paypal_transaction_id' => '15F41997GB955064L',
                'created_at' => now()
            ],
        );

        Request::insert($requests);
    }
}