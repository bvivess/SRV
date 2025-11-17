<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
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
            //'Technology',
        ];

        $posts = [
            'What is Lorem Ipsum?',
            'Why do we use it?',
            'Where does it come from?',
        ];

        // Crear 'Tags'
        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);  // 'firstOrCreate()' per evitar duplicats
        }

        // Crear 'Posts' 
        foreach ($posts as $post) {
            $post = Post::create([
                'title'       => $post,
                'url_clean'   => $post, // EXISTEIX UN MUTADOR: 'strtolower(str_replace(' ', '_', $post)),'
                'content'     => fake()->paragraphs(3, true),
                'user_id'     => User::inRandomOrder()->first()->id,  // assignar un usuari aleatori
                'category_id' => Category::inRandomOrder()->first()->id,  // assignar una categoria aleatòria
            ]);

            // Assignar etiquetes aleatòries al post
            $randomTags = collect($tags)->random(2);
            foreach ($randomTags as $tag) {
                $tag = Tag::where('name', $tag)->first();
                $post->tags()->attach($tag->id, ['created_at' => now(), 'updated_at' => now()]);  // 'syncWithoutDetaching()' evita duplicats
            }
        }
    }
}