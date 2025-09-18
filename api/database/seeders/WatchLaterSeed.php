<?php

namespace Database\Seeders;

use App\Models\WatchLater;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WatchLaterSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WatchLater::factory(50)->create();
    }
}
