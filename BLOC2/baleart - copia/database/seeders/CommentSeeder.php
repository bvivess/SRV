<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Space;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        // Des d'un arxiu JSON
        $jsonData = file_get_contents('c:\\temp\\baleart\\comentaris.json');
        $comentaris = json_decode($jsonData, true);

        foreach ($comentaris['comentaris']['comentari'] as $comentari) {
            Comment::create([
                'user_id' => User::where('email', $comentari['usuari'])->first()->id,
                'space_id' => Space::where('regNumber', $comentari['espai'])->first()->id,
                'score' => $comentari['puntuacio'],
                'comment' => $comentari['text'],
                'status' => fake()->boolean ? 'y' : 'n',
                'created_at' => Carbon::createFromFormat('d-m-Y H:i:s', $comentari['data'] . ' ' . $comentari['hora'])->toDateTimeString(),
                'updated_at' => now()
            ]); 
        }
    }
}
