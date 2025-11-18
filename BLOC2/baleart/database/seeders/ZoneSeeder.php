<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents("C:\\temp\\baleart\\zones.json");
        $zones = json_decode($jsonData, true);

        foreach($zones["zones"]["zona"] as $zona) {
            Zone::create([
                "name" => $zona["Nom"]
            ]);
        }
    }
}
