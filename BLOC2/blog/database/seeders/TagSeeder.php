<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Technology',
            'Health',
            'Lifestyle',
            'Education',
            'Travel',
            'Food',
            'Finance',
            'Science',
            'Sports',
            'Entertainment',
            // 'Technology', // duplicat per provar 'firstOrCreate()'
        ];

        // Crear 'Tags'
        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);  // 'firstOrCreate()' per evitar duplicats
        }
    }
}
