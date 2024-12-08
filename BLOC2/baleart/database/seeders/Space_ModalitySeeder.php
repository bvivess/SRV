<?php

namespace Database\Seeders;

use App\Models\Space;
use App\Models\Modality;
use App\Models\Space_Modality;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Space_ModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Des d'un arxiu JSON
        $jsonData = file_get_contents('c:\\temp\\baleart\\espais.json');
        $spaces = json_decode($jsonData, true);

        foreach ($spaces as $space) {
            Space_Modality::create([
                'space_id' => Space::where('name', $space['nom'])->first()->id,
                'modality_id' => Modality::inRandomOrder()->first()->id  //Modality::where('description_CA', $space['modalitat'])->first()->id
            ]);
        }
    }
}
