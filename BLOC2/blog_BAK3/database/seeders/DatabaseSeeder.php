<?php

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\TagSeeder;
use Database\Seeders\PostSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeders
        $this->call(UserSeeder::class);  // Crea 1 seeder concret
        $this->call(TagSeeder::class);
        $this->call(PostSeeder::class);

        // JSON
        $this->call(CategorySeeder::class);
        
        // Factories
        $tag = new Tag();
        $tag->name = "Prova1";
        $tag->url_clean = "prova1";
        $tag->save();
        $tag = new Tag();
        $tag->name = "Prova2";
        $tag->url_clean = "prova2";
        $tag->save();
        User::factory(5)->create();  // Crea 5 Factories aleatòris
        Category::factory(5)->create();
        $posts = Post::factory(20)->create();
        $tags = Tag::factory(10)->create();
        $comments = Comment::factory(100)->create();
        $images = Image::factory(100)->create();

        //Post_Tag::factory(5)->create();
        $posts->each(function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
