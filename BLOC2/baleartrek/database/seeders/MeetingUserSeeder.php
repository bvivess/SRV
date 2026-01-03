<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Meeting;

class MeetingUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $role_id = Role::where('name', 'visitant')->value('id');
        $usersIds = User::where('role_id', $role_id)->get()->pluck('id');
        $totalUsers = $usersIds->count();
        $meetings = Meeting::all();
        foreach ($meetings as $meeting) {
            // Seleccionar entre 10 a 20 usuaris aleatoris (per exemple)
            $randomUsersId = $usersIds->random(rand(min(10, $totalUsers), min(20, $totalUsers)));  // entre 10 i 20 usuaris
            // Assignar-los al meeting, evitant duplicats
            $meeting->users()->attach($randomUsersId);
        }
    }
}
