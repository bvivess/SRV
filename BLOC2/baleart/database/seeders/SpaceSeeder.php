<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\Zone;
use App\Models\Space;
use App\Models\Address;
use App\Models\Service;
use App\Models\Modality;
use App\Models\SpaceType;
use App\Models\Municipality;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Carregar les dades de la base de dades en arrays associatius
        $modalities = Modality::all()->keyBy('name')->toArray(); // Array asociatiu [ 'name' => Modality ]
        $services = Service::all()->keyBy('name')->toArray(); // Array asociatiu [ 'name' => Service ]
        $municipalities = Municipality::all()->keyBy('name')->toArray(); // Array asociatiu [ 'name' => Municipality ]
        $zones = Zone::all()->keyBy('name')->toArray(); // Array asociatiu [ 'name' => Zone ]
        $spaceTypes = SpaceType::all()->keyBy('name')->toArray(); // Array asociatiu [ 'name' => SpaceType ]
        $users = User::all()->keyBy('email')->toArray(); // Array asociatiu [ 'email' => User ]

        // Des d'un arxiu JSON
        $jsonData = file_get_contents('c:\\temp\\baleart\\espais.json');
        $spaces = json_decode($jsonData, true);

        foreach ($spaces as $space) {
            // Address
            $newAddress = Address::create([
                'name' => $space['adreca'],
                'municipality_id' => $municipalities[$space['municipi']]['id'],  // Municipality::where('name', $space['municipi'])->first()->id,
                'zone_id' => $zones[$space['zona']]['id'],  //Zone::where('name', $space['zona'])->first()->id,
            ]);

            // Space
            $newSpace = Space::create([
                'name' => $space['nom'],
                'regNumber' => $space['registre'],
                'observation_CA' => $space['descripcions/cat'],
                'observation_ES' => $space['descripcions/esp'],
                'observation_EN' => $space['descripcions/eng'],
                'phone' => $space['telefon'],
                'email' => $space['email'],
                'website' => $space['web'],
                'accessType' => ($space['accessibilitat'] === "Sí") ? 'y' : (($space['accessibilitat'] === "No") ? 'n' : 'p'),
                'totalScore' => 0,
                'countScore' => 0,
                'space_type_id' => $spaceTypes[$space['tipus']]['id'],  // SpaceType::where('name', $space['tipus'])->first()->id,
                'address_id' => $newAddress->id,
                'user_id' => $users[$space['gestor']]['id'] ?? $users['admin@baleart.com']['id'],  // User::where('email', $space['gestor'])->first()->id ?? User::where('email', 'admin@baleart.com')->first()->id
            ]);

            // Modality_Space
            if ($space['modalitats'] !== "") 
                foreach (explode(',',$space['modalitats']) as $modalitat) {
                    $modalityId = $modalities[trim($modalitat)]['id'];  // Modality::where('name', trim($modalitat))->first()->id;                
                    $newSpace->modalities()->attach($modalityId, ['created_at' => now(), 'updated_at' => now()]);
                }
            

            // Service_Space
            if ($space['serveis'] !== "") 
                foreach (explode(',',$space['serveis']) as $servei) {
                    $serveiId = $services[trim($servei)]['id'] ?? null;  // Service::where('name', trim($servei))->first()->id;
                    $newSpace->services()->attach($serveiId, ['created_at' => now(), 'updated_at' => now()]);
                }
        }

        // Descarregar els arrays associatius
        unset($modalities, $services, $municipalities, $zones, $spaceTypes, $users);
    }
}
