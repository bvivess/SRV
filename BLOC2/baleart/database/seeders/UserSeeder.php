<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $adminRole = Role::where('name', 'admin')->value('id');
        $user = USER::create([
            'name'      => 'admin',
            'lastname'  => 'admin',
            'email'     => 'admin@baleart.com',
            'email_verified_at' => now(),
            'phone'     => '971123456',
            'password'  => Hash::make('12345678'),
            'role_id'   => $adminRole,
        ]);

        // Des d'un arxiu JSON
        $jsonData = file_get_contents('c:\\temp\\baleart\\usuaris.json');
        $usuaris = json_decode($jsonData, true);

        $gestorRole = Role::where('name', 'gestor')->value('id');
        foreach ($usuaris['usuaris']['usuari'] as $usuari) {
            User::create([
                'name'      => $usuari['nom'],
                'lastname'  => $usuari['llinatges'],
                'email'     => $usuari['email'],
                'email_verified_at' => now(),
                'phone'     => $usuari['telefon'],
                'password'  => Hash::make('12345678'),
                'role_id'   => $gestorRole,
            ]);
        }
    }
}
