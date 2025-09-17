<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieLikeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $movies = Movie::all();

        if ($users->isEmpty() ||$movies->isEmpty()) {
            return;
        }

        foreach($users as $user) {
            $likedMovies = $movies->random(rand(1, 4)); 

            foreach($likedMovies as $movie) {
                $movie->likes()->firstOrCreate(['user_id' => $user->id]);
            }
        }
    }
}
