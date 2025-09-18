<?php

namespace Database\Seeders;

use App\Models\Follow;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Follow::factory(50)->create();
    }
}
