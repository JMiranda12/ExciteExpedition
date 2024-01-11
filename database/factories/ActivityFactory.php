<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Host;
use App\Models\Activity;
use App\Models\Item;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Carbon\Carbon;

class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $item = Item::factory()->create();
        $firstDate = Carbon::parse('2022-01-01');
        $lastDate = Carbon::parse('2023-12-31');
        $randomDate = $this->faker->dateTimeBetween($firstDate,$lastDate)->format('Y-m-d');

        return [
            "item_id" => $item['id'],
            "title" => $item['name'],
            "description" => $this->faker->realText(),
            "first_date" => $randomDate,
            "last_date" => $randomDate,
            "language_id" => $this->faker->numberBetween(1, Language::all()->count()),
            "country_id" => $this->faker->numberBetween(1, Country::all()->count()),
            "duration" => $this->faker->numberBetween(0,120),
            "category_id" => $this->faker->numberBetween(1,4),
        ];
    }
/*
    public function hasHost(): ActivityFactory
    {
        return $this->state(function (array $attributes) {
            return [
                "host_id" => $this->faker->numberBetween(1, Host::all()->count()),
            ];
        });
    }
*/
}
