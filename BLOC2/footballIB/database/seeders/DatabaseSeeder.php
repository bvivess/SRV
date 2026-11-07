<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Executant Seeders ...');
        $this->call([ RoleSeeder::class,
                      UserSeeder::class,
                      CountrySeeder::class,
                      ProvinceSeeder::class,
                      LocationSeeder::class ]);
    }
}
