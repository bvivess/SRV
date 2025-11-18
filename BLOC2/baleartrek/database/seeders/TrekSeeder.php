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
        $municipalities = Municipality::all()->keyBy('name')->toArray(); // Array asociatiu [ 'name' => Municipality ]
        $users = User::all()->keyBy('dni')->toArray(); // Array asociatiu [ 'dni' => User ]

        // Des d'un arxiu JSON
        $jsonData = file_get_contents(env('APP_TEMP') . "treks.json");
        $treks = json_decode($jsonData, true);

        // Recórrer els 'treks' del JSON
        foreach ($treks as $trek) {
            // '$newTrek' emmagatzema el nou 'trek' creat
            $newTrek = Trek::create([
                            'regNumber'       => $trek['regNumber'],
                            'name'            => $trek['name'],
                            'status'          => 'y',
                            'municipality_id' => $municipalities[$trek['municipality']]['id'], //Municipality::where('name', $trek['municipality'])->value('id'),
                        ]);
            // Recórrer els 'meetings' del '$trek'
            foreach ($trek['meetings'] as $meeting) {
                // '$newMeeting' emmagatzema el nou 'meeting' creat
                $newMeeting = Meeting::create([
                                    'user_id'    => $users[$meeting['DNI']]['id'],
                                    'trek_id'    => $newTrek->id,
                                    'day'        => $meeting['day'],
                                    'time'       => $meeting['time'],
                                    'appDateIni' => Carbon::parse($meeting['day'])->subMonth(),
                                    'appDateEnd' => Carbon::parse($meeting['day'])->subWeek(),
                                ]);
                // Recórrer els 'comments' del '$meeting'
                foreach ($meeting['comments'] as $comment) {
                    Comment::create([
                        'meeting_id' => $newMeeting->id,
                        'comment'    => $comment['comment'],
                        'user_id'    => $users[$comment['DNI']]['id'],
                        'score'      => $comment['score'],
                        'status'     => 'y',
                    ]);
                }
            }

        }       
    }
}
