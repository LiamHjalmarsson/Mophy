<?php

namespace Database\Seeders;

use App\Models\WatchLater;
use Illuminate\Database\Seeder;

class WatchLaterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WatchLater::factory(50)->create();
    }
}
