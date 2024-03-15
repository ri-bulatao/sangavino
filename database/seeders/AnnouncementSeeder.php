<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Services\ActivityLogService;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogService $service)
    {
        $announcements = array(
            [
                'id' => 1,
                'title' => 'Please claim your national ID at the barangay hall.',
                'content' => '
                    1. PACITA FLORES 
                    2. EDZAIRA MARTINEZ 
                    3. ROMEO POLON
                    4. CHRISTIAN A. BAUTISTA 
                    5. LARIELYN HOPE RODRIGUEZ
                    6. JENNIFER D. POLON
                    7. RONNIE RICK MARQUEZ 
                    8. IRVIN JAN FIELDAD 
                    9. MARGARITA S. LAUDE
                    10. DERICK MENDAROS
                    11. AEBLYN JOY AGGABAO
                    12. VICTOR BAHIW
                ',

                'has_sms' => false,
                'sms_announcement' => null,
                'created_at' => now()->subHour(2)
            ],
            [
                'id' => 2,
                'title' => "Chikiting ligtas, sa dagdag bakuna kontra polio, rubella, at tigdas",
                'content' => '
                    <p>
                    Chikiting ligtas, sa dagdag bakuna kontra polio, rubella, at tigdas
                    </p>
                ',

                'has_sms' => false,
                'sms_announcement' => null,
                'created_at' => now()->subHours()
            ],
            // [
            //     'id' => 3,
            //     'title' => 'B-BIDA KA! Barangay BIDA Ka',
            //     'content' => '
            //         <p>
            //         B-BIDA KA! Barangay BIDA Ka sa Pagpapatupad ng Kapayapaan, Pangangalaga ng Kalikasan, at Pagpapaigting ng Pagkakaisa Tungo sa Isang Ligtas, Mapayapa, Maunlad, at Masaganang Pamayanan
            //         </p>
            //     ',
            //     'has_sms' => false,
            //     'sms_announcement' => null,
            //     'created_at' => now()
            // ],
        );

        Announcement::insert($announcements);

        Announcement::all()->each(function($announcement) use($service) {
            $announcement
                ->addMedia(public_path("/img/tmp_files/announcements/$announcement->id.png"))
                ->preservingOriginal()
                ->toMediaCollection('announcement_images');
            
            $service->log_activity(model:$announcement, event:'added', model_name: 'Announcement', model_property_name: $announcement->title, conjunction:'an');
        });
    }
}