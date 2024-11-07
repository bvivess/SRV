<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Des d'un arxiu JSON
        $jsonData = file_get_contents('c:\\temp\\serveis.json');
        $services = json_decode($jsonData, true);

        foreach ($services['serveis']['servei'] as $service) {
            Service::create([
                'description_ca' => $service['cat'],
                'description_es' => $service['esp'],
                'description_en' => $service['eng']
            ]);
        }
    }
}
