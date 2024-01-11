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
            ['path' => '3.jpg', 'activity_id' => 3],
        ];

        foreach ($photos as $photo) {
            ActivityPhoto::create($photo);
        }
    }
}
