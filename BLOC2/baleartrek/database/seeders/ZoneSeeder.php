<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zone;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents(env('APP_TEMP') . "zones.json");
        $zones = json_decode($jsonData, true);

        foreach($zones["zones"]["zona"] as $zona) {
            Zone::create([
                "name" => $zona["Nom"]
            ]);
        }
    }
}
