<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;
use App\Models\Province;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = [
            'localidades_espana.json',
            'localidades_francia.json'
        ];

        foreach ($files as $file) {
            $jsonData = file_get_contents(env('APP_TEMP') . $file);
            $locations = json_decode($jsonData, true);

            foreach ($locations as $location) {
                Location::create([
                    'name' => $location['DESCRIPCION'],
                    'province_id' => Province::where('name', $location['PROVINCIA_ID'])->value('id'),
                ]);
            }
        }
    }
}
