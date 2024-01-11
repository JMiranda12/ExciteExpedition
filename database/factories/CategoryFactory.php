<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->getFixedCategory(),
            'registration_date' => now(),
            'update_date' => now(),
        ];
    }
    private function getFixedCategory(): string
    {
        static $categories = ['Desporto', 'Cultura', 'Gastronomia', 'Natureza'];
        return array_shift($categories);
    }
}
