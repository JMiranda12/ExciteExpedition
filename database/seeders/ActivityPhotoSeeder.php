<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ActivityPhoto;
use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivityPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $photos = [
            ['path' => '1.jpeg', 'activity_id' => 1],
            ['path' => '2.jpeg', 'activity_id' => 2],
            ['path' => '3.jpeg', 'activity_id' => 3],
            ['path' => '4.jpeg', 'activity_id' => 4],
            ['path' => '5.jpeg', 'activity_id' => 5],
            ['path' => '6.jpeg', 'activity_id' => 6],
            ['path' => '7.jpeg', 'activity_id' => 7]
        ];

        foreach ($photos as $photo) {
            ActivityPhoto::create($photo);
        }
    }
}
