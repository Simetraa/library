<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory()->create([
            'email' => 'test@example.com',
            'branch_id' => 1,
        ]);

        User::factory()->create([
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'email' => 'staff@example.com',
            'role' => 'staff',
        ]);

        User::factory()->create([
            'email' => 'testing@example.com',
            'branch_id' => 1,
        ]);
    }
}
