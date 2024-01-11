<?php

namespace Database\Factories;

use App\Models\ItemType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name(),
            'price' => $this->faker->randomFloat(2, 4.99, 49.99),
            'registration_date' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            'update_date' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            'flag_delete' => $this->faker->boolean(50),
            'item_type_id' => rand(1, ItemType::all()->count()),
        ];
    }
}
