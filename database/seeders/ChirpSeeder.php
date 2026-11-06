<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChirpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a few sample users if they don't exist
        $users = User::count() < 3
                    ? collect([
                        User::create([
                            'name' => 'Alice',
                            'email' => 'alice@email.com',
                            'password' => bcrypt('password'),
                        ]),
                        User::create([
                            'name' => 'Bob',
                            'email' => 'bob@email.com',
                            'password' => bcrypt('password'),
                        ]),
                        User::create([
                            'name' => 'Tom',
                            'email' => 'tom@email.com',
                            'password' => bcrypt('password'),
                        ]),
                    ])
                    :User::take(3)->get();

        $chirps = [
            'Just discovered Laravel - where has this been all my life? 🚀',
            'Building something cool with Chirper today!',
            'Laravel\'s Eloquent ORM is pure magic ✨',
            'Deployed my first app with Laravel Cloud. So smooth!',
            'Who else is loving Blade components?',
            'Friday deploys with Laravel? No problem! 😎',
        ];

        foreach ($chirps as $text) {
            $users->random()->chirps()->create([
                'text' => $text,
                'created_at' => now()->subMinutes(rand(5,1440)),
            ]);
        }
    }
}
