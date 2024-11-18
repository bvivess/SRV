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
            $user = User::where('email', $comentari['usuari'])->first();
            $space = Space::where('regNumber', $comentari['espai'])->first();
            $commentari = $comentari['text'];
            $punts= $comentari['puntuacio'];
            
            /*
            // a partir dels models M:N
            $space->users()->attach($user->id, [ 'score' => $punts,
                                                 'comment' => $commentari,
                                                 'status' => 'n'
                                            ]);
            */
            
            // a partir del model ('Comment'<->'space_user') de la relació M:N
            $comment = new Comment();
            $comment->user_id = $user->id;
            $comment->space_id = $space->id;
            $comment->score = $punts;
            $comment->comment = $commentari;
            $comment->status = fake()->boolean ? 'y' : 'n';
            $diaHora = $comentari['data'] . ' ' . $comentari['hora'];
            $comment->created_at = Carbon::createFromFormat('d-m-Y H:i:s', $diaHora)->toDateTimeString();
            $comment->updated_at = Carbon::createFromFormat('d-m-Y H:i:s', $diaHora)->toDateTimeString();
            $comment->save();  
        }
    }
}
