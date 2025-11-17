<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\TagSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\PostSeeder;
use App\Models\User;
use App\Models\Comment;
use App\Models\Image;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeders / JSON
        $this->command->info('Ejecutando Seeders ...');
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PostSeeder::class);

        // Factories
        $this->command->info('Ejecutando Factories ...');
        User::factory(10)->create();
        Comment::factory(100)->create();
        Image::factory(100)->create();
    }
}
