<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Services\ActivityLogService;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogService $service)
    {
        $positions = array(
            ['id' => 1,'pid' => 0,'name' => 'Punong Barangay', 'created_at' => now()],
            ['id' => 2,'pid' => 1,'name' => 'Treasurer ', 'created_at' => now()],
            ['id' => 3,'pid' => 1,'name' => 'Barangay Secretary', 'created_at' => now()],
            ['id' => 4,'pid' => 1,'name' => 'Barangay Kagawad', 'created_at' => now()],
            ['id' => 5,'pid' => 1,'name' => 'SK Chairman', 'created_at' => now()],
            ['id' => 6,'pid' => 1,'name' => 'Barangay Chief Tanod', 'created_at' => now()],
            ['id' => 7,'pid' => 5,'name' => 'Barangay Tanod', 'created_at' => now()],
        );

        Position::insert($positions);

        Position::all()->map(fn(
            $position) => $service->log_activity(model:$position, event:'added', model_name: 'Position', model_property_name: $position->name)
        );
    }
}