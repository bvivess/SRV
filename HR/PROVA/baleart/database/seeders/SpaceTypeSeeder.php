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
        $jsonData = file_get_contents('c:\\temp\\tipus.json');
        $spaceTypes = json_decode($jsonData, true);

        foreach ($spaceTypes['tipusespais']['tipus'] as $spaceType) {
            SpaceType::create([
                'description_ca' => $spaceType['cat'],
                'description_es' => $spaceType['esp'],
                'description_en' => $spaceType['eng']
            ]);
        }
    }
}
