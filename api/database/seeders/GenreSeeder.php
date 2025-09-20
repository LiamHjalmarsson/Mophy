<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ['name' => 'Action'],
            ['name' => 'Comedy'],
            ['name' => 'Drama'],
            ['name' => 'Horror'],
            ['name' => 'Sci-Fi'],
            ['name' => 'Fantasy'],
            ['name' => 'Thriller'],
            ['name' => 'Romance'],
            ['name' => 'Animation'],
            ['name' => 'Documentary'],
        ];

        foreach ($genres as $genre) {
            Genre::firstOrCreate(['name' => $genre['name']], $genre);
        }
    }
}
