<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\Country;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = [
            'provincias_espana.json',
            'provincias_francia.json'
        ];

        foreach ($files as $file) {
            $jsonData = file_get_contents(env('APP_TEMP') . $file);
            $provinces = json_decode($jsonData, true);

            foreach ($provinces as $province) {
                Province::create([
                    'name' => $province['DESCRIPCION'],
                    'country_id' => Country::where('name', $province['PAIS_ID'])->value('id'),
                ]);
            }
        }
    }
}
