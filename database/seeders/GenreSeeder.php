<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define an array of genre data to be inserted
        $genres = [
            [
                'genre_name' => 'Action',
                'description' => 'Exciting action-packed genres.',
            ],
            [
                'genre_name' => 'Drama',
                'description' => 'Emotional and character-driven stories.',
            ],
            [
                'genre_name' => 'Comedy',
                'description' => 'Funny and humorous stories.',
            ],
            [
                'genre_name' => 'Horror',
                'description' => 'Scary and frightening stories.',
            ],

            [
                'genre_name' => 'Romance',
                'description' => 'Love and romantic stories.',
            ],
            [
                'genre_name' => 'Thriller',
                'description' => 'Suspenseful and thrilling stories.',
            ],
            [
                'genre_name' => 'Mystery',
                'description' => 'Mysterious and puzzling stories.',

            ],
            [
                'genre_name' => 'Crime',
                'description' => 'Stories about criminals and the law.',
            ],

            [
                'genre_name' => 'Adventure',
                'description' => 'Exciting and thrilling stories.',

            ],

            [
                'genre_name' => 'Fantasy',
                'description' => 'Stories about magic and supernatural forces.',
            ],

            [
                'genre_name' => 'Science Fiction',
                'description' => 'Stories about science and technology.',
            ]
            // Add more genre data as needed
        ];

        // Insert the data into the "genres" table
        DB::table('genres')->insert($genres);
    }
}
