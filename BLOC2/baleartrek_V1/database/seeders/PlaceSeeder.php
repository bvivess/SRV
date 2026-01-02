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
            try {
                // Cercar el 'trek' pel 'regNumber'
                $newTrek = Trek::where('regNumber', $trek['regNumber'])->firstOrFail();  // millor que 'first' per capturar errors

                // Recórrer els 'places_of_interest' del '$trek'
                $order = 1;
                foreach ($trek['places_of_interest'] as $place) {
                    // Crear o obtenir el tipus de lloc
                    $newPlaceType = PlaceType::firstOrCreate(
                        ['name' => $place['type']]);

                    // Crear o obtenir el lloc d'interès
                    $newInterestingPlace = InterestingPlace::firstOrCreate(
                        [
                          'gps' => $place['gpsPos']  // 'gps' com a identificador únic
                        ],[
                          'name' => $place['name'],
                          'place_type_id' => $newPlaceType->id,
                        ]);

                    // Insertar en la taula pivot amb l'ordre
                    $newTrek->interestingPlaces()->attach($newInterestingPlace->id, [ 'order' => $order++, ]);
                }
            } catch (\Exception $e) {
                // Registrar l'error:
                $this->command->info("Error al processar el trek amb regNumber {$trek['regNumber']}: " . $e->getMessage());
            }
        }
    }
}
