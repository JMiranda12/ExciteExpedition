<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Host;
use App\Models\Category;
use App\Models\Activity;
use App\Models\HostActivity;
use App\Models\CategoryActivity;
use App\Models\Language;
use App\Models\ActivityPhoto;
use Database\Factories\ActivityFactory;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {


        Category::factory()->count(4)->create();
        Country::factory()->count(100)->create();
        ActivityFactory::new()->count(7)->create();


        /* // Popula a HostActivity
         foreach(Activity::all() as $activity) {
            HostActivity::factory()->create([
                'activity_item_id' => $activity->item_id,
                'host_id' => rand(1, Host::All()->count())
            ]);
        }
        */

        // Popula a CategoryActivity
       foreach(Activity::all() as $activity) {
            CategoryActivity::factory()->create([
                'activity_item_id' => $activity->item_id,
                'category_id' => rand(1, Category::All()->count())
            ]);
        }


   }
}
