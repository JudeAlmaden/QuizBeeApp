<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Quiz;
use App\Models\UserQuizRel;
use App\Models\categories;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed with accounts
        User::create([
            'id' => 'Admin',
            'name' => 'Admin',
            'password' => Hash::make('Admin'),
            'privilege' => 'user'
        ]);

        User::create([
            'id' => 'Team-1',
            'name' => 'Team - 1',
            'password' => Hash::make('GM07'),
            'privilege' => 'user'
        ]);

        User::create([
            'id' => 'Team-2',
            'name' => 'Team - 2',
            'password' => Hash::make('PL34'),
            'privilege' => 'user'
        ]);

        User::create([
            'id' => 'Team-3',
            'name' => 'Team - 3',
            'password' => Hash::make('YHN4'),
            'privilege' => 'user'
        ]);
        User::create([
            'id' => 'Team-4',
            'name' => 'Team - 4',
            'password' => Hash::make('MX67'),
            'privilege' => 'user'
        ]);
        User::create([
            'id' => 'Team-5',
            'name' => 'Team - 5',
            'password' => Hash::make('YU34'),
            'privilege' => 'user'
        ]);
    }
}
