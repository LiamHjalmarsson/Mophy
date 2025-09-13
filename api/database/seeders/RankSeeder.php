<?php

namespace Database\Seeders;

use App\Models\Rank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rank::insert([
            ['name' => 'Beginner', 'level' => 1, 'description' => 'New user'],
            ['name' => 'Pro', 'level' => 10, 'description' => 'Experienced user'],
            ['name' => 'Legend', 'level' => 50, 'description' => 'Top tier user'],
        ]);
    }
}
