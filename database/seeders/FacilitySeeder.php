<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = \Faker\Factory::create();
        Facility::create([
            'facility_name' => 'Wifi',
            'category' =>  "Umum",
        ]);
        Facility::create([
            'facility_name' => 'Dapur',
            'category' =>  "Umum",
        ]);
        Facility::create([
            'facility_name' => 'Parkiran Motor',
            'category' =>  "Umum",
        ]);
        Facility::create([
            'facility_name' => 'Parkiran Mobil',
            'category' =>  "Umum",
        ]);
        Facility::create([
            'facility_name' => 'WC/Kamar Mandi',
            'category' => "Kamar",
        ]);
        Facility::create([
            'facility_name' => 'TV',
            'category' => "Kamar",
        ]);
        Facility::create([
            'facility_name' => 'Lemari',
            'category' => "Kamar",
        ]);
    }
}
