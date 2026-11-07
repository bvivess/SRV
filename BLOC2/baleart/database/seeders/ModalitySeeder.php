<?php

namespace Database\Seeders;

use App\Models\Modality;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Des d'un arxiu JSON
        $jsonData = file_get_contents('c:\\temp\\baleart\\modalitats.json');
        $modalities = json_decode($jsonData, true);

        foreach ($modalities['modalitats']['modalitat'] as $modality) {
            Modality::create([
                'name'           => $modality['cat'],
                'description_CA' => $modality['cat'],
                'description_ES' => $modality['esp'],
                'description_EN' => $modality['eng']
            ]);
        }
    }
}
