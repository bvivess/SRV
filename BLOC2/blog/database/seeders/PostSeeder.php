<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Carregar el fitxer JSON
        $jsonData = file_get_contents(env('APP_TEMP') . 'posts.json');
        $posts = json_decode($jsonData, true);

        foreach ($posts['posts'] as $post) {
            try {
                $newPost = Post::create([
                                'title'       => $post['title'],
                                'url_clean'   => $post['url_clean'],
                                'content'     => $post['content'],
                                'user_id'     => User::where('dni', $post['user_dni'])->value('id'),
                                'category_id' => Category::where('title', $post['category'])->value('id'),
                            ]);

                // Cercar o crear els tags i obtenir els seus IDs
                $tagIds = [];
                foreach ($post['tags'] as $tagName) {
                    $tag = Tag::firstOrCreate(['name' => $tagName]);  // Tag::where('name', $tagName)->first() ?? Tag::create(['name' => $tagName]);
                    $tagIds[] = $tag->id;
                }

                // Assignar els tags al post (relació molts a molts)
                $newPost->tags()->attach($tagIds);

            } catch (\Exception $e) {
                $this->command->info("Error al processar el post '{$post['title']}': " . $e->getMessage());
            }
        }
    }
}