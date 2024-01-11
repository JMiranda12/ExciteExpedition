<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Activity;
use App\Models\CategoryActivity;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() : array
    {
        return [
            'activity_item_id' => 1,
            'category_id' => 1
        ];
    }
}
