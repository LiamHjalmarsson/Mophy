<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Seeder;

class WatchedSeeder extends Seeder
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

        foreach ($users as $user) {
            $watchedMovies = $movies->random(rand(1, 5));
           
            foreach ($watchedMovies as $movie) {
                $user->watcheds()->updateOrCreate(
                    ['movie_id' => $movie->id],
                    ['watched_at' => now()->subDays(rand(0, 365))]
                );
            }
        }
    }
}
