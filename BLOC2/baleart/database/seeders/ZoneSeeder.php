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
        $zones = [
            'Centre',
            'Ponent',
            'Nord',
            'Llevant',
            'Sud'
        ];

        foreach ($zones as $zone) {
            $newZone = new Zone();
            $newZone->name = $zone;
            $newZone->save();
        }

    }
}
