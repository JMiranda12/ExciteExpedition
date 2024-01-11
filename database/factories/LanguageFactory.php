<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $languages = [
            'Português',
            'Francês',
            'Inglês',
            'Espanhol',
        ];

        $languageName = $this->faker->unique()->randomElement($languages);

        return [
            'name' => $languageName,
            ];
    }
}
