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
        // Obtenir tots posts
        $posts = [
            'What is Lorem Ipsum?',
            'Why do we use it?',
            'Where does it come from?',
        ];

        // Obtenir tots els IDs de tags
        $tagsId = Tag::all()->pluck('id');

        // Crear 'Posts' 
        foreach ($posts as $post) {
            $post = Post::create([
                'title'       => $post,
                'url_clean'   => $post, // EXISTEIX UN MUTADOR: 'strtolower(str_replace(' ', '_', $post)),'
                'content'     => fake()->paragraphs(3, true),
                'user_id'     => User::inRandomOrder()->value('id'),  // assignar un usuari aleatori
                'category_id' => Category::inRandomOrder()->value('id'),  // assignar una categoria aleatòria
            ]);

            // Assignar tags aleatoris al post
            $randomTagsIds = $tagsId->random(rand(1, $tagsId->count()));  // entre 1 i el total de 'tags'
            $post->tags()->attach($randomTagsIds);
        }
    }
}