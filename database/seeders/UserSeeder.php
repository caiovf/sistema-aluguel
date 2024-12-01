<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'teste@example.com',
            'password' => Hash::make('senha123')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin Test User',
            'email' => 'admin@example.com',
            'password' => Hash::make('senha123'),
            'role' => 'admin'
        ]);
    }
}
