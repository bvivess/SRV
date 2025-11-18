<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trek;
use App\Models\PlaceType;
use App\Models\InterestingPlace ;

class PlaceSeeder extends Seeder
{
    public function run(): void
    {
        // Des d'un arxiu JSON
        $jsonData = file_get_contents(env('APP_TEMP') . "places.json");
        $places = json_decode($jsonData, true);

        // Recórrer els 'treks' del JSON
        foreach ($places as $trek) {
            // Buscar el 'trek' pel 'regNumber'
            $newTrek = Trek::where('regNumber', $trek['regNumber'])->first();

            // Recórrer els 'places_of_interest' del '$trek'
            $order = 1;
            foreach ($trek['places_of_interest'] as $place) {
                // Crear o obtenir el tipus de lloc
                $newPlaceType = PlaceType::firstOrCreate(['name' => $place['type']]);

                // Crear o obtenir el lloc d'interès
                $newPlaceModel = InterestingPlace::firstOrCreate(
                    ['name' => $place['name']], // Nom com a identificador únic
                    [
                        'gps' => $place['gpsPos'],
                        'place_type_id' => $newPlaceType->id,
                    ]
                );

                // Associar el lloc al trek sense duplicar
                $newTrek->interestingPlaces()->attach($newPlaceModel->id, [ 'order' => $order++, ]);
            }
        }
    }
}
