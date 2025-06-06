<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buff;

class BuffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buff::upsert(
            [
                [
                    'code'        => 'FOCUS_MEDITATION',
                    'name'        => 'Mindful Focus',
                    'description' => '10-minute mindfulness session',
                    'multiplier'  => 0.15,
                    'duration'    => 120,
                    'applies_to'  => json_encode(['cognitive']),  // ◀ JSON‐encode the array
                    'stackable'   => false,
                    'max_stacks'  => 1,
                    'cooldown'    => 12,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ],
                [
                    'code'        => 'KETONE_FAST',
                    'name'        => 'Ketone Boost',
                    'description' => '≥14-hour fasting window complete',
                    'multiplier'  => 0.15,
                    'duration'    => 720,
                    'applies_to'  => json_encode(['cognitive', 'physical']),
                    'stackable'   => false,
                    'max_stacks'  => 1,
                    'cooldown'    => 24,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ],
                [
                    'code'        => 'POMODORO_FOCUS',
                    'name'        => 'Pomodoro Focus',
                    'description' => 'One 25 min focus + 5 min break block',
                    'multiplier'  => 0.10,
                    'duration'    => 50,
                    'applies_to'  => json_encode(['cognitive']),
                    'stackable'   => false,
                    'max_stacks'  => 1,
                    'cooldown'    => 1,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ],
                // …add more buffs if you like…
            ],
            /* unique by */
            ['code'],
            /* columns to update on conflict */
            [
                'name',
                'description',
                'multiplier',
                'duration',
                'applies_to',
                'stackable',
                'max_stacks',
                'cooldown',
                'updated_at',
            ]
        );
    }
}
