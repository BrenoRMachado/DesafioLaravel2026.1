<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    public function run(): void {
        \App\Models\Produto::factory(36)->create();
    }
}
