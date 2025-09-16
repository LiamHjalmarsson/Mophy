<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::factory(10)->create();

        foreach ($categories as $category) {
            $category->movies()->attach(
                Movie::inRandomOrder()->take(rand(2, 5))->pluck('id')
            );
        }
    }
}
