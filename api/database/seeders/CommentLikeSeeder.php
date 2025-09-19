<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $comments = Comment::all();

        if ($users->isEmpty() || $comments->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            $likedComments = $comments->random(rand(1, 3));
            
            foreach ($likedComments as $comment) {
                $comment->likes()->updateOrCreate(
                    ['user_id' => $user->id],
                    ['type' => fake()->randomElement(['like', 'dislike'])]
                );
            }
        }
    }
}
