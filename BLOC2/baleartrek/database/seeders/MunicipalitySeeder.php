<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipality;
use App\Models\Island;
use App\Models\Zone;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Carregar les dades de la base de dades en arrays associatius
        $islands = Island::all()->keyBy('name')->toArray(); // Crea un array asociatiu [ 'name' => Island ]
        $zones = Zone::all()->keyBy('name')->toArray(); // Crea un array asociatiu [ 'name' => Island ]

        $jsonData = file_get_contents(env('APP_TEMP') . "municipalities.json");
        $municipalities = json_decode($jsonData, true);

        foreach($municipalities["municipis"]["municipi"] as $municipality) {
            Municipality::create([
                "name" => $municipality["Nom"],
                "island_id" => $islands[$municipality["Illa"]]["id"],
                "zone_id" => $zones[$municipality["Zona"]]["id"],
            ]);
        }
    }
}
