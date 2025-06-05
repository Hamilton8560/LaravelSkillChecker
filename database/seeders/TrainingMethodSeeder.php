<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class TrainingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed these methods for the same “default” user:
        $user = User::first();
        if (! $user) {
            $user = User::factory()->create([
                'name'  => 'DevSeed User',
                'email' => 'devseed@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        $methods = [
            'Tutorial',
            'Reading',
            'Practical Application',
            'Testing',
            'Video Courses',
            'Teaching',
            'Open Source',
            'Blogging',
        ];

        foreach ($methods as $name) {
            DB::table('training_methods')->updateOrInsert(
                [
                    'user_id' => $user->id,
                    'name'    => $name,
                ],
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}