<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Produto;
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
            'name' => 'Breno',
            'email' => 'admin@codejr.com.br',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        User::factory(8)->create(['is_admin' => true]);
        User::factory(18)->create(['is_admin' => false]);
        Produto::factory(36)->create();
    }
}
