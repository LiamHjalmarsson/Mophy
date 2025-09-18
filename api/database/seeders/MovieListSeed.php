<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\MovieList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieListSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MovieList::factory(5)->hasAttached(Movie::factory()->count(5))->create();
    }
}
