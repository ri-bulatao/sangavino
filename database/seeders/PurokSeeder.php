<?php

namespace Database\Seeders;

use App\Models\Purok;
use App\Services\ActivityLogService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogService $service)
    {
        $puroks = array(
            ['name' => 'Purok A', 'created_at' => now()],
            ['name' => 'Purok B', 'created_at' => now()],
            ['name' => 'Purok C', 'created_at' => now()],
            ['name' => 'Purok D', 'created_at' => now()],
        );

        Purok::insert($puroks);

        Purok::all()->map(fn(
            $purok) => $service->log_activity(model:$purok, event:'added', model_name: 'Purok', model_property_name: $purok->name)
        );
    }
}
