<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\AdminFactory;

class AdminSeeder extends Seeder
{
    public function run(): void {
        \App\Models\User::factory()->create([
            'name' => 'Breno',
            'email' => 'admin@codejr.com.br',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'is_admin' => true,
        ]);
        \Database\Factories\AdminFactory::new()->count(8)->create();
}
}
