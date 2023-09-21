<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors = [
            [
                'first_name' => 'J.K.',
                'last_name' => 'Rowling',
                'biography' => 'British author best known for writing the Harry Potter series.',
            ],
            [
                'first_name' => 'George',
                'last_name' => 'Orwell',
                'biography' => 'English novelist and essayist known for his works "1984" and "Animal Farm."',
            ],

            [
                'first_name' => 'Stephen',
                'last_name' => 'King',
                'biography' => 'American author known for his works in the horror and fantasy genres.',
            ],

            [
                'first_name' => 'J.R.R.',
                'last_name' => 'Tolkien',
                'biography' => 'English author and academic best known for writing "The Hobbit" and "The Lord of the Rings."',
            ],

            [
                'first_name' => 'Agatha',
                'last_name' => 'Christie',
                'biography' => 'English writer known for her 66 detective novels and 14 short story collections.',
            ],

            [
                'first_name' => 'Dan',
                'last_name' => 'Brown',
                'biography' => 'American author known for his works "The Da Vinci Code" and "Angels & Demons."',
            ],


            // Add more authors as needed
        ];

        foreach ($authors as $author) {
            Author::create([
                'first_name' => $author['first_name'],
                'last_name' => $author['last_name'],
                'biography' => $author['biography'],
            ]);
        }
    }
}

