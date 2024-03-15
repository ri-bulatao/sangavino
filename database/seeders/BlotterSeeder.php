<?php

namespace Database\Seeders;

use App\Models\Blotter;
use App\Services\ActivityLogService;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlotterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogService $service)
    {
        $blotters = array(
            [
                'id' => 1,
                'complainant' => 'Sample Complainant',
                'respondent' => 'Sample Respondent',
                'official_id' => 1,
                'location' => 'Sample Location, Philippines',
                'date_of_incident' => now()->subWeek(),
                'statement' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit quas, blanditiis ipsa itaque labore id iure nesciunt iste nemo aliquid quidem, est autem tempora tenetur!',
                'is_solved' => 0,
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'complainant' => 'Dev Ace',
                'respondent' => 'Michelle Yu',
                'official_id' => 1,
                'location' => 'Sample Location, Philippines',
                'date_of_incident' => now(),
                'statement' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit quas, blanditiis ipsa itaque labore id iure nesciunt iste nemo aliquid quidem, est autem tempora tenetur!',
                'is_solved' => 1,
                'created_at' => now(),
            ],
        );

        Blotter::insert($blotters);

        Blotter::all()->map(fn(
            $blotter) => $service->log_activity(model:$blotter, event:'added', model_name: 'Blotter', model_property_name: "Blotter #ID $blotter->id")
        );
    }
}