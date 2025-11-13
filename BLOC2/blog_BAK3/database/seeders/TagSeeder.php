<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Senderisme',
            'Ciclisme',
            'Cultura',
        ];

        foreach ($tags as $tag) {
            $newTag = new Tag();
            $newTag->name = $tag;
            $newTag->save();
        }
    }
}