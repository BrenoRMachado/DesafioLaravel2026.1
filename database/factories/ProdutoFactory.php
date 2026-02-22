<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->word(),
            'preco' => $this->faker->randomFloat(2, 10, 5000),
            'foto' => null,
            'quantidade' => $this->faker->numberBetween(1, 100),
            'descricao' => $this->faker->sentence(),
            'categoria' => $this->faker->randomElement(['Eletrônicos', 'Periféricos', 'Acessórios']),
            'data_criacao' => now(),
            //'usuario_id' => \App\Models\User::all()->random()->id,
            'usuario_id' => \App\Models\User::factory(),
        ];
    }
}
