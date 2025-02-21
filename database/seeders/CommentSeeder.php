<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $announcements = Announcement::all();

        foreach ($announcements as $announcement) {
            Comment::factory(5)->create([
                'announcement_id' => $announcement->id,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}
