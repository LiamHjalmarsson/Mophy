<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $users = User::all();

        foreach ($users as $user) {
            $user->following()->attach(
                $users->random(rand(1, 5))->pluck('id')->toArray()
            );
        }
    }
}
