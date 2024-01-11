<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->unique()->name,
            'registration_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'update_date' => now()->format('Y-m-d'), // Provide a value for update_date
            ];
    }
}
