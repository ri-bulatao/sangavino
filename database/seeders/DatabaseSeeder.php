<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Run Seeders
       
        $this->call([

            /** Start User Management*/
                RoleSeeder::class,
                PurokSeeder::class,
                ResidentSeeder::class,
                UserSeeder::class,
                PositionSeeder::class,
                OfficialSeeder::class,
            /** End User Management*/

            /** Start Service Management*/
                ServicesSeeder::class,
                BlotterSeeder::class,
                RequestSeeder::class,
            /** End Service Management*/

            /** Start Announcement Management*/
                AnnouncementSeeder::class,
                CommentSeeder::class,
            /** End Announcement Management*/

            /** Start Product Management */
                CategorySeeder::class,
                ProductSeeder::class,
            /** End Product Management */
            
        ]);

    }
}