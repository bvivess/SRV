<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuari d'inici
        $adminUser = new User();
        $adminUser->name = "Tomeu V.";
        $adminUser->email = "bvives@iesemilidarder.com";
        $adminUser->password = Hash::make('12345678');
        $adminUser->save();
    }
}
