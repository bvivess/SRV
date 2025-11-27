<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipality;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents(env('APP_TEMP') . "municipalities.json");
        $municipalities = json_decode($jsonData, true);

        foreach($municipalities["municipis"]["municipi"] as $municipality) {
            Municipality::create([
                "name" => $municipality["Nom"],
                "island_id" => 1, // $municipality["IllaID"]
                "zone_id" => 1,   // $municipality["ZonaID"]
            ]);
        }
    }
}
