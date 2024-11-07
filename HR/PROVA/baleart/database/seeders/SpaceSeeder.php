<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Space;
use App\Models\Service;
use App\Models\SpaceType;
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
        $jsonData = file_get_contents('c:\\temp\\espais.json');
        $spaces = json_decode($jsonData, true);

        foreach ($spaces as $space) {
            $espaiId = SpaceType::where('description_CA', $space['tipus'])->first()->id;
            $addrecaId = 1;
            $userId = 1;//User::where('email', $space['email'])->first();
            Space::create([
                'name' => $space['nom'],
                'regNumber' => $space['registre'],
                'observation_CA' => $space['descripcions/cat'],
                'observation_ES' => $space['descripcions/esp'],
                'observation_EN' => $space['descripcions/eng'],
                'phone' => $space['telefon'],
                'email' => $space['email'],
                'website' => $space['web'],
                'accessType' => 'y',
                'totalValuations' => 0,
                'totalScore' => 0,
                'space_type_id' => $espaiId,
                'address_id' => $addrecaId,
                'user_id' => $userId
            ]);
        }
    }
}
