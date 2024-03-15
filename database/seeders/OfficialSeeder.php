<?php

namespace Database\Seeders;

use App\Models\Official;
use App\Services\ActivityLogService;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OfficialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogService $service)
    {
        $officials = array(

            // Punong Barangay
            [
                'id' => 1,
                'position_id' => 1, 
                'name' => 'Edgar L. Santiago', 
                'contact' => '09283707767',
                'is_active' => true,
                'created_at' => now()
            ],

            // Treasurer
            [
                'id' => 2,
                'position_id' => 2, 
                'name' => 'Dianina C. Paradero', 
                'contact' => '09283707767',
                'is_active' => true,
                'created_at' => now()
            ],

            // Secretary
            [
                'id' => 3,
                'position_id' => 3, 
                'name' => 'Aring B. Gastador', 
                'contact' => '09283707767',
                'is_active' => true,
                'created_at' => now()
            ],

            // Kagawad
            [
                'id' => 4,
                'position_id' => 4, 
                'name' => 'Emily S. Caluya', 
                'contact' => '09283707767',
                'is_active' => true,
                'created_at' => now()
            ],
            [
                'id' => 5,
                'position_id' => 4, 
                'name' => 'Warlie Rackman S. Dimaporo', 
                'contact' => '09283707767',
                'is_active' => true,
                'created_at' => now()
            ],
            [
                'id' => 6,
                'position_id' => 4, 
                'name' => 'Marilou G. Gacusan', 
                'contact' => '09283707767',
                'is_active' => true,
                'created_at' => now()
            ],
            [
                'id' => 7,
                'position_id' => 4, 
                'name' => 'Raphael Carlo P. Magno', 
                'contact' => '09283707767',
                'is_active' => true,
                'created_at' => now()
            ],
            [
                'id' => 8,
                'position_id' => 4, 
                'name' => 'Harold G. Felipe', 
                'contact' => '09283707767',
                'is_active' => true,
                'created_at' => now()
            ],
            [
                'id' => 9,
                'position_id' => 4, 
                'name' => 'Francis S. Galindo', 
                'contact' => '09283707767',
                'is_active' => true,
                'created_at' => now()
            ],
            [
                'id' => 10,
                'position_id' => 4, 
                'name' => 'Jose N. Agustin', 
                'contact' => '09283707767',
                'is_active' => true,
                'created_at' => now()
            ],

            // SK CHairman
            [
                'id' => 11,
                'position_id' => 5, 
                'name' => 'Angel Niño P. Layug', 
                'contact' => '09283707767',
                'is_active' => true,
                'created_at' => now()
            ],

            // Chief Tanod
            [
                'id' => 12,
                'position_id' => 6, 
                'name' => 'Ricardo B. Agunos', 
                'contact' => '09283707767',
                'is_active' => true,
                'created_at' => now()
            ],


            // Tanod
            // [
            //     'id' => 12,
            //     'position_id' => 6, 
            //     'name' => 'Larry M. Luna', 
            //     'contact' => '09283707767',
            //     'is_active' => true,
            //     'created_at' => now()
            // ],
            // [
            //     'id' => 13,
            //     'position_id' => 6, 
            //     'name' => 'George C. Gamido Jr', 
            //     'contact' => '09283707767',
            //     'is_active' => true,
            //     'created_at' => now()
            // ],
            // [
            //     'id' => 14,
            //     'position_id' => 6, 
            //     'name' => 'Jomar F. Paje', 
            //     'contact' => '09283707767',
            //     'is_active' => true,
            //     'created_at' => now()
            // ],

        );

        Official::insert($officials);

        Official::all()->map(fn(
            $official) => $service->log_activity(model:$official, event:'added', model_name: 'Official', model_property_name: $official->name, conjunction:'an')
        );
    }
}