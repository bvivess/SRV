<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\IslandSeeder;
use Database\Seeders\ZoneSeeder;
use Database\Seeders\MunicipalitySeeder;
use Database\Seeders\TrekSeeder;
use Database\Seeders\PlaceSeeder;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use App\Models\MeetingUseSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        try {
            // Seeders / JSON
            $this->command->info('Executant Seeders ...');
            $this->call(RoleSeeder::class);
            $this->call(UserSeeder::class);
            $this->call(IslandSeeder::class);
            $this->call(ZoneSeeder::class);
            $this->call(MunicipalitySeeder::class);
            $this->call(TrekSeeder::class);
            $this->call(PlaceSeeder::class);

            // factories
            $this->command->info('Executant Factories ...');
            User::factory(100)->create();
            Image::factory(100)->create();
            Comment::factory(100)->create();
            
            $this->command->info('Completant Seeders ...');
            $this->call(MeetingUserSeeder::class);
        } catch (\Exception $e) {
            $this->command->error("Error durant l'execució dels seeders/factories: " . $e->getMessage());
        }
    }
}
