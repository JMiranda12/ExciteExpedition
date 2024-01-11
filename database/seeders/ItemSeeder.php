<?php

namespace Database\Seeders;

use App\Models\ItemType;
use App\Models\Language;
use Database\Factories\ActivityFactory;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {

        ItemType::factory()->count(1)->create();
        Language::factory(4)->create();

        // Vai chamando os seeders dos diferentes items
        $this->call([
            ActivitySeeder::class
        ]);
    }
}
