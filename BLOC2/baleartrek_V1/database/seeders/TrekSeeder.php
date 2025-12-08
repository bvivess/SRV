<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trek;
use App\Models\Meeting;
use App\Models\Municipality;
use App\Models\User;
use App\Models\Comment;
use App\Models\InterestingPlace;

class TrekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Carregar les dades de la base de dades en arrays associatius
        $municipalities = Municipality::all()->keyBy('name')->toArray(); // Crea un array asociatiu [ 'name' => Municipality ]
        $users = User::all()->keyBy('dni')->toArray(); // Crea un array asociatiu [ 'dni' => User ]

        // Des d'un arxiu JSON
        $jsonData = file_get_contents(env('APP_TEMP') . "treks.json");
        $treks = json_decode($jsonData, true);

        // Recórrer els 'treks' del JSON
        foreach ($treks as $trek) {
            try {
                // '$newTrek' emmagatzema el nou 'trek' creat
                $newTrek = Trek::firstOrCreate(
                                [ 'regNumber'       => $trek['regNumber'],
                                ],[     
                                'name'            => $trek['name'],
                                'status'          => 'y',
                                'municipality_id' => $municipalities[$trek['municipality']]['id'], //Municipality::where('name', $trek['municipality'])->value('id'),
                            ]);
                // Recórrer els 'meetings' del '$trek'
                foreach ($trek['meetings'] as $meeting) {
                    // '$newMeeting' emmagatzema el nou 'meeting' creat
                    $newMeeting = Meeting::firstOrCreate(
                                        [ 'trek_id'    => $newTrek->id,
                                          'day'        => $meeting['day'],
                                          'time'       => $meeting['time'],
                                        ],[ 
                                          'user_id'    => $users[$meeting['DNI']]['id'],  //User::where('dni', $meeting['DNI'])->value('id'),
                                          'appDateIni' => Carbon::parse($meeting['day'])->subMonth(),
                                          'appDateEnd' => Carbon::parse($meeting['day'])->subWeek(),
                                        ]);
                    // Recórrer els 'comments' del '$meeting'
                    foreach ($meeting['comments'] as $comment) {
                        Comment::create([
                            'meeting_id' => $newMeeting->id,
                            'user_id'    => $users[$comment['DNI']]['id'],  //User::where('dni', $comment['DNI'])->value('id'),
                            'comment'    => $comment['comment'],
                            'score'      => $comment['score'],
                            'status'     => 'y',
                        ]);
                    }
                }
            } catch (\Exception $e) {
                // Registrar l'error:
                $this->command->info("Error al processar el trek amb regNumber {$trek['regNumber']}: " . $e->getMessage());
            }
        }
    }
}
