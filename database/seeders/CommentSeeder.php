<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogService $service)
    {
        $comments = array(
            [
                'id' => 1,
                'user_id' => 2,
                'announcement_id' => 2,
                'comment' => 'Thanks Admin!',
                'created_at' => now()
            ],
            // [
            //     'id' => 2,
            //     'user_id' => 3,
            //     'announcement_id' => 3,
            //     'comment' => 'Sample comment one!',
            //     'created_at' => now()
            // ],
            // [
            //     'id' => 3,
            //     'user_id' => 4,
            //     'announcement_id' => 3,
            //     'comment' => 'Sample comment two!',
            //     'created_at' => now()
            // ],
        );

        Comment::insert($comments);

        Comment::all()->map(fn(
            $comment) => $service->log_activity(model:$comment, event:'added', model_name: 'Service', model_property_name: $comment->comment, end_user: $comment->user->full_name)
        );
    }
}