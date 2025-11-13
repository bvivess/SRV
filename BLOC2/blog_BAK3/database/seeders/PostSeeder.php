<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            'What is Lorem Ipsum?',
            'Why do we use it?',
            'Where does it come from?',
        ];

        foreach ($posts as $post) {
            $newPost = new Post();
            $newPost->title = $post;
            $newPost->url_clean = strtolower(str_replace(' ', '_', $post));
            $newPost->content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
            $newPost->user_id = User::inRandomOrder()->first()->id;
            $newPost->category_id = Category::inRandomOrder()->first()->id;
            $newPost->save();

            // Associar el lloc al trek sense duplicar
            $newTag->posts()->attatch($newPost->id, [] );
        }
    }
}