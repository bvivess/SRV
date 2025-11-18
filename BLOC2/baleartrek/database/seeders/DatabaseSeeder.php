<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\IslandSeeder;
use Database\Seeders\ZoneSeeder;
use Database\Seeders\MunicipalitySeeder;
use Database\Seeders\TrekSeeder;
use Database\Seeders\PlaceSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Seeders / JSON
        $this->command->info('Ejecutando Seeders ...');
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(IslandSeeder::class);
        $this->call(ZoneSeeder::class);
        $this->call(MunicipalitySeeder::class);
        $this->call(TrekSeeder::class);
        $this->call(PlaceSeeder::class);

        // factories
        $this->command->info('Ejecutando Factories ...');
        User::factory(100)->create();
        Image::factory(100)->create();
    }
}
