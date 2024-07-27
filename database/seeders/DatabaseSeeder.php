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
            'id' => '0000-0000',
            'name' => 'Master',
            'password' => Hash::make('master'),
            'privilege' => 'user'
        ]);

        User::create([
            'id' => '0000-0001',
            'name' => 'Team - 1',
            'password' => Hash::make('player1'),
            'privilege' => 'user'
        ]);

        User::create([
            'id' => '0000-0002',
            'name' => 'Team - 2',
            'password' => Hash::make('player2'),
            'privilege' => 'user'
        ]);

        User::create([
            'id' => '0000-0003',
            'name' => 'Team - 3',
            'password' => Hash::make('player3'),
            'privilege' => 'user'
        ]);
    }
}
