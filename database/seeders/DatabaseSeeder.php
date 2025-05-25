<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'username' => 'test',
            'email' => 'test@example.com',
        ]);
        User::factory()->create([
            'name' => 'Test User 2',
            'username' => 'test2',
            'email' => 'test2@example.com',
        ]);
        User::factory()->create([
            'name' => 'Test User 3',
            'username' => 'test3',
            'email' => 'test3@example.com',
        ]);
    }
}
