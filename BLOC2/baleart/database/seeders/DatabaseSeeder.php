<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ZoneSeeder;
use Database\Seeders\IslandSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\ModalitySeeder;
use Database\Seeders\SpaceTypeSeeder;
use Database\Seeders\MunicipalitySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeders
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(IslandSeeder::class);
        $this->call(ZoneSeeder::class);

        // JSON
        $this->call(MunicipalitySeeder::class);
        $this->call(SpaceTypeSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(ModalitySeeder::class);
        $this->call(SpaceSeeder::class);
        $this->call(CommentSeeder::class);
        
        // Factories
        User::factory(50)->create();
        Image::factory(50)->create();
    }
}
