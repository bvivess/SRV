<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuari d'inici
        $user = new User();
        $user->name = "admin";
        $user->lastname = "admin";
        $user->email = "admin@abc.com";
        $user->password = Hash::make('12345678');
        $user->role_id = Role::where('name', 'admin')->value('id');  // 'value('id')' retorna l’id del primer 'Role' que coincideixi amb la condició, o null si no existeix cap.
        $user->dni = fake()->unique()->regexify('[0-9]{8}[A-Z]');    // equivalent a 'Role::where('name', 'admin')->first()->id;'
        $user->phone = fake()->unique()->regexify('[0-9]{9}');
        $user->save();                                               

        // Des d'un arxiu JSON
        $jsonData = file_get_contents(env('APP_TEMP') . 'users.json');
        $usuaris = json_decode($jsonData, true);

        $gestorRole = Role::where('name', 'visitant')->value('id');
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
