<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\ProvinceSeeder;
use Database\Seeders\LocationSeeder;
use App\Models\User;
use App\Models\Person;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeders / JSON
        $this->command->info('Executant Seeders ...');
        $this->call([ RoleSeeder::class,
                      UserSeeder::class,
                      CountrySeeder::class,
                      ProvinceSeeder::class,
                      LocationSeeder::class ]);

        // factories
        $this->command->info('Executant Factories ...');
        User::factory(100)->create();
        Person::factory(100)->create();
    }
}
