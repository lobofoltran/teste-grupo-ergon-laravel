<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Teste 1',
            'email' => 'test@test.com',
            'password' => Hash::make('1234'),
        ]);

        User::factory()->create([
            'name' => 'Teste 2',
            'email' => 'test2@test.com',
            'password' => Hash::make('1234'),
        ]);
    }
}
