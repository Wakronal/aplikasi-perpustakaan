<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => 'Ronaldi Saputra',
            'email' => 'admin@ronal.com',
            'password' => Hash::make('ronal123'),
        ]);

        User::factory()->create([
            'name' => 'Muhammad Hariqbal Dewantara',
            'email' => 'admin@iqbal.com',
            'password' => Hash::make('iqbal123'),
        ]);

        User::factory()->create([
            'name' => 'Hafidz Pandu Tizal',
            'email' => 'admin@hafidz.com',
            'password' => Hash::make('hafidz123'),
        ]);

        User::factory()->create([
            'name' => 'Muhammad Rafly Novryandry',
            'email' => 'admin@rafly.com',
            'password' => Hash::make('rafly123'),
        ]);
    }
}
