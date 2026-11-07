<?php

namespace Database\Seeders;

use App\Models\SpaceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpaceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Des d'un arxiu JSON
        $jsonData = file_get_contents('c:\\temp\\baleart\\tipus.json');
        $spaceTypes = json_decode($jsonData, true);

        foreach ($spaceTypes['tipusespais']['tipus'] as $spaceType) {
            SpaceType::create([
                'name'           => $spaceType['cat'],
                'description_CA' => $spaceType['cat'],
                'description_ES' => $spaceType['esp'],
                'description_EN' => $spaceType['eng']
            ]);
        }
    }
}
