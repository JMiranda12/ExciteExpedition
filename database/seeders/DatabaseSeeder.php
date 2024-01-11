<?php

namespace Database\Seeders;


use App\Models\ActivityPhoto;
use App\Models\Address;
use App\Models\Host;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\Language;
use App\Models\OrderStatus;
use App\Models\User;
use App\Models\City;
use App\Models\Country;
use App\Models\UserType;
use App\Models\HostActivity;
use Database\Factories\ActivityFactory;
use Database\Factories\OrderFactory;
use Database\Factories\HostActivityFactory;
use Database\Factories\CategoryActivityFactory;
use Database\Factories\CountryFactory;
use Database\Factories\CityFactory;
use Database\Factories\AddressFactory;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ItemSeeder::class,

            //OrderSeeder::class,
            ActivityPhotoSeeder::class
        ]);
    }
}
