<?php

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(UserSeeder::class);  // Crea 1 seeder concret
        $this->call(CategorySeeder::class);
        
        // Factories
        User::factory(5)->create();  // Crea 5 Factories aleatòris
        Category::factory(5)->create();
        $posts = Post::factory(20)->create();
        $tags = Tag::factory(10)->create();
        //Post_Tag::factory(5)->create();
        $posts->each(function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
