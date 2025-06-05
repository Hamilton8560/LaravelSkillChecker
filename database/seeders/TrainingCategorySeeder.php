<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class TrainingCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        if (! $user) {
            $user = User::factory()->create([
                'name'      =>  'DevSeed User',
                'email'     =>  'devseed@example.com',
                'password'  =>  bcrypt('password'),
            ]);
        }

        $categories = [
            'Laravel',
            'Livewire',
            'React',
            'JavaScript',
            'PHP',
            'Frontend',
            'Design',
            'System Architecture',
            'MySQL',
            'PostgreSQL',
            'NoSQL',
            'DevOps',
        ];
        foreach ($categories as $name) {
            DB::table('training_categories')->updateOrInsert(
                [
                    'user_id'   =>  $user->id,
                    'name'      =>  $name,
                ],
                [
                    'created_at'    => now(),
                    'updated_at'    =>  now(),
                ]
            
                );
    }
}

}