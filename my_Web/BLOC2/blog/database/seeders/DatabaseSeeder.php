<?php

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminUser = new User();
        $adminUser->name = "Tomeu V.";
        $adminUser->email = "bvives@iesemilidarder.com";
        $adminUser->password = Hash::make('12345678');
        $adminUser->save();


        $this->call(CategorySeeder::class);
        
        User::factory(5)->create();
        Category::factory(5)->create();
        Post::factory(5)->create();
    }
}
