<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $languages=[
            [
                'language_name' => 'English',

            ],
            [
                'language_name' => 'French',

            ],
            [
                'language_name' => 'Spanish',

            ],
            [
                'language_name' => 'German',

            ],
            [
                'language_name' => 'Italian',

            ],

        ];
        foreach ($languages as $language) {
            Language::create([
                'language_name' => $language['language_name'],
            ]);
        }
    }


}
