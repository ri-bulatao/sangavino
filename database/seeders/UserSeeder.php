<?php

namespace Database\Seeders;

use App\Models\Admin\Role;
use App\Models\User;
use App\Services\ActivityLogService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogService $service)
    {
        $users = array(
            // generate sample admin
             [
                'id' => 1,
                 'resident_id' => null,
                 'email' => 'admin@gmail.com', 
                 'password' => Hash::make('secret'),
                 'is_activated' => true, 
                 'role_id' => Role::ADMIN,
                 'created_at' => now()
             ],

            // generate sample admin
             [
                'id' => 2,
                 'resident_id' => null,
                 'email' => 'secretary@gmail.com', 
                 'password' => Hash::make('secret'),
                 'is_activated' => true, 
                 'role_id' => Role::SECRETARY,
                 'created_at' => now()
             ],
 
           // generate sample residents
             [
                'id' => 3,
                'resident_id' => 1,
                 'email' => 'resident@gmail.com', 
                 'password' => Hash::make('secret'),
                 'is_activated' => true, 
                 'role_id' => Role::RESIDENT,
                 'created_at' => now()
             ],

             [
                'id' => 4,
                'resident_id' => 2,
                 'email' => 'abbeyparadero19@gmail.com', 
                 'password' => Hash::make('secret'),
                 'is_activated' => true, 
                 'role_id' => Role::RESIDENT,
                 'created_at' => now()
             ],
             [
                'id' => 5,
                'resident_id' => 3,
                 'email' => 'chloeanne.verlice16@gmail.com', 
                 'password' => Hash::make('secret'),
                 'is_activated' => true, 
                 'role_id' => Role::RESIDENT,
                 'created_at' => now()
             ],
          );
 
          User::insert($users);

          User::all()->each(function($user) {
            $user
            ->addMedia(public_path("/img/tmp_files/avatars/$user->id.png"))
            ->preservingOriginal()
            ->toMediaCollection('avatar_image');
        });

        $service->log_activity(model: User::find(1), event:'seeded', model_name: 'User Account', model_property_name: 'seeded users');

    }
}