<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question'   => fake()->realText(50), //Cria uma questão com no máximo 50 caracteres
            'draft'      => fake()->boolean(),
            'created_by' => User::factory(), // Se eu não passar nada ele cria uma factory de User
        ];
    }
}
