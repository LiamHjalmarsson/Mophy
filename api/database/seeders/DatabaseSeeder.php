<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MovieSeeder::class,
            MovieLikeSeeder::class,
            CategorySeeder::class,
            CommentSeeder::class,
            CommentLikeSeeder::class,
            WatchedSeeder::class,
            WatchLaterSeeder::class,
            FollowSeeder::class,
            MovieListSeeder::class,
            ReviewSeeder::class
        ]);

        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
