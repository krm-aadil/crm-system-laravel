<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = [
            [
                'name' => 'Western Province',
                'latitude' => 6.9271,
                'longitude' => 79.8612,
            ],
            [
                'name' => 'Central Province',
                'latitude' => 7.2707,
                'longitude' => 80.5918,
            ],
            [
                'name' => 'Southern Province',
                'latitude' => 5.9631,
                'longitude' => 80.4807,
            ],
            [
                'name' => 'Northern Province',
                'latitude' => 9.6627,
                'longitude' => 80.0232,
            ],
            [
                'name' => 'Eastern Province',
                'latitude' => 7.7952,
                'longitude' => 81.6694,
            ],
            [
                'name' => 'North Western Province',
                'latitude' => 7.4896,
                'longitude' => 80.3540,
            ],
            [
                'name' => 'North Central Province',
                'latitude' => 8.0382,
                'longitude' => 80.8178,
            ],
            [
                'name' => 'Uva Province',
                'latitude' => 6.8215,
                'longitude' => 81.1047,
            ],
            [
                'name' => 'Sabaragamuwa Province',
                'latitude' => 6.5064,
                'longitude' => 80.5968,
            ],
        ];

        // Insert data into the provinces table
        DB::table('provinces')->insert($provinces);
    }
}
