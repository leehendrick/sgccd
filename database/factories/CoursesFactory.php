<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Courses>
 */
class CoursesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => 'Cursos LabPro',
            'descricao' => 'Cursos Oferecidos pelo LabPro',
            'duracao' => '2 semanas',
            'preco' => 15.999,
            'data_inicio' => fake()->date(),
            'data_termino' => fake()->date(),
            'local' => 'Laboratório Profissionalizante',
            'vagas' => fake()->numberBetween(1,20),
            'requisitos' => fake()->word(),
            'status' => fake()->word(),
            'categories_id' => 1,
        ];
    }
}
