<?php

namespace Database\Factories;

use App\Models\Host;
use App\Models\Activity;
use App\Models\HostActivity;

use Illuminate\Database\Eloquent\Factories\Factory;

class HostActivityFactory extends Factory
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
            'host_id' => 1
        ];
    }
}
