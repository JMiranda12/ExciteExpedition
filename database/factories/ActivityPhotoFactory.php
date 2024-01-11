<?php

namespace Database\Factories;

use App\Models\ActivityPhoto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityPhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'path' => $this->faker->image('public/storage/images', 640, 480, null, false),
        ];
    }
}
