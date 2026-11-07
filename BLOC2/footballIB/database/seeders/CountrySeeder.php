<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Païs d'inici
        Country::create(['name' => 'España']);

        // Des d'un arxiu JSON
        $jsonData = file_get_contents(env('APP_TEMP') . "paises_europa.json");
        $countries = json_decode($jsonData, true); 

        foreach ($countries as $country) {
            Country::create([
                'name' => $country["DESCRIPCION"],
            ]);
        }
    }
}
