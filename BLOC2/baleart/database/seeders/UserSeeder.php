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
        $adminUser = new User();
        $adminUser->name = "admin";
        $adminUser->lastname = "admin";
        $adminUser->email = "admin@baleart.com";
        $adminUser->email_verified_at = now();
        $adminUser->password = Hash::make('12345678');
        $adminUser->role_id = Role::where('name', 'admin')->value('id');
        $adminUser->save();

        // Des d'un arxiu JSON
        $jsonData = file_get_contents('c:\\temp\\baleart\\usuaris.json');
        $usuaris = json_decode($jsonData, true);

        foreach ($usuaris['usuaris']['usuari'] as $usuari) {
            User::create([
                'name'      => $usuari['nom'],
                'lastname'  => $usuari['llinatges'],
                'email'     => $usuari['email'],
                'email_verified_at' => now(),
                'phone'     => $usuari['telefon'],
                'password'  => Hash::make($usuari['password']),
                'role_id'   => Role::where('name', 'gestor')->value('id')
            ]);
        }
    }
}
