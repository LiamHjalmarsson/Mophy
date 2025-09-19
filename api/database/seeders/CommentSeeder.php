<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $movies = Movie::all();

        if ($users->isEmpty() || $movies->isEmpty()) {
            return;
        }

        foreach($movies as $movie) {
            Comment::factory(rand(3, 7))->create([
                'movie_id' => $movie->id,
                'user_id' => $users->random()->id
            ]);
        }
    }
}
