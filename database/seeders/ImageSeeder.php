<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $images = [];
        // for ($i = 1; $i <= 15; $i++) {
        //     $images[] = [
        //         'house_id' => ceil($i / 3),
        //         'name' => "Image $i",
        //         'url' => "images/house/$i.jpg",
        //     ];
        // }
        $images = [
            [
                'house_id' => 1,
                'name' => 'Image 1',
                'url' => 'images/house/1.jpg',
            ],
            [
                'house_id' => 1,
                'name' => 'Image 2',
                'url' => 'images/house/2.jpg',
            ],
            [
                'house_id' => 1,
                'name' => 'Image 3',
                'url' => 'images/house/3.jpg',
            ],
            [
                'house_id' => 2,
                'name' => 'Image 4',
                'url' => 'images/house/4.jpg',
            ],
            [
                'house_id' => 3,
                'name' => 'Image 5',
                'url' => 'images/house/5.jpg',
            ],
            [
                'house_id' => 4,
                'name' => 'Image 6',
                'url' => 'images/house/6.jpg',
            ],
            [
                'house_id' => 5,
                'name' => 'Image 7',
                'url' => 'images/house/7.jpg',
            ],
        ];

        foreach ($images as $image) {
            Image::create($image);
        }
    }
}
