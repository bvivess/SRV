<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuari d'inici
        $user = User::create([
            'name'      => 'admin',
            'lastname'  => 'admin',
            'dni'       => '00000000A',
            'email'     => 'admin@baleartrek.com',
            'email_verified_at' => now(),
            'phone'     => '971123456',
            'password'  => Hash::make('12345678'),
            'role_id'   => Role::where('name', 'admin')->value('id'),
        ]);

        // Des d'un arxiu JSON
        $jsonData = file_get_contents(env('APP_TEMP') . "users.json");
        $usuaris = json_decode($jsonData, true);

        $gestorRole = Role::where('name', 'guia')->value('id');
        foreach ($usuaris['usuaris']['usuari'] as $usuari) {
            User::create([
                'name'      => $usuari['nom'],
                'lastname'  => $usuari['llinatges'],
                'dni'       => $usuari['dni'],
                'email'     => $usuari['email'],
                'email_verified_at' => now(),
                'phone'     => $usuari['telefon'],
                'password'  => Hash::make('12345678'),
                'role_id'   => $gestorRole,
            ]);
        }
    }
}
