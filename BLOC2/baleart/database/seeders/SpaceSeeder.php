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
        // Des d'un arxiu JSON
        $jsonData = file_get_contents('c:\\temp\\baleart\\espais.json');
        $spaces = json_decode($jsonData, true);

        foreach ($spaces as $space) {
            // Address
            $newAddress = Address::create([
                'name' => $space['adreca'],
                'municipality_id' => Municipality::where('name', $space['municipi'])->first()->id,
                'zone_id' => Zone::where('name', $space['zona'])->first()->id
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
                'accessType' => 'y',
                'totalScore' => 0,
                'countScore' => 0,
                'space_type_id' => SpaceType::where('name', $space['tipus'])->first()->id,
                'address_id' => $newAddress->id,
                'user_id' => User::where('email', $space['gestor'])->first()->id ?? User::where('name', 'admin')->first()->id
            ]);

            // Modality_Space
            if ($space['modalitats'] !== "") 
                foreach (explode(',',$space['modalitats']) as $modalitat) {
                    $modalityId = Modality::where('name', trim($modalitat))->first()->id;                
                    $newSpace->modalities()->attach($modalityId);
                }
            

            // Service_Space
            if ($space['serveis'] !== "") 
                foreach (explode(',',$space['serveis']) as $servei) {
                    $serveiId = Service::where('name', trim($servei))->first()->id;
                    $newSpace->services()->attach($serveiId);
                }
        }
    }
}
