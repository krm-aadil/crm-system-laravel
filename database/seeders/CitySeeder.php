<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                'name' => 'Colombo',
                'latitude' => 6.9271,
                'longitude' => 79.8612,
            ],
            [
                'name' => 'Kandy',
                'latitude' => 7.2906,
                'longitude' => 80.6337,
            ],
            [
                'name' => 'Galle',
                'latitude' => 6.0367,
                'longitude' => 80.2170,
            ],
            [
                'name' => 'Jaffna',
                'latitude' => 9.6613,
                'longitude' => 80.0255,
            ],
            [
                'name' => 'Negombo',
                'latitude' => 7.2095,
                'longitude' => 79.8351,
            ],
            [
                'name' => 'Matara',
                'latitude' => 5.9555,
                'longitude' => 80.5490,
            ],
            [
                'name' => 'Anuradhapura',
                'latitude' => 8.3126,
                'longitude' => 80.4175,
            ],
            [
                'name' => 'Polonnaruwa',
                'latitude' => 7.9403,
                'longitude' => 81.0188,
            ],
            [
                'name' => 'Badulla',
                'latitude' => 6.9837,
                'longitude' => 81.0550,
            ],
            [
                'name' => 'Kurunegala',
                'latitude' => 7.4843,
                'longitude' => 80.3660,
            ],
            // Add more cities as needed
        ];

        // Insert data into the cities table
        DB::table('cities')->insert($cities);
    }
}
