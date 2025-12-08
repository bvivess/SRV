<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Island;

class IslandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $islands = [
            'Mallorca',
            'Menorca',
            'Eivissa',
            'Formentera',
            'Cabrera'
        ];

        foreach ($islands as $island) {
            Island::create([
                'name' => $island
            ]);
        }
    }
}
