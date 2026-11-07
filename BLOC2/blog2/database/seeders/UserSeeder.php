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
        $user = User::create([
            'name'      => 'admin',
            'lastname'  => 'admin',
            'dni'       => '00000000A',
            'email'     => 'admin@baleartrek.com',
            'email_verified_at' => now(),
            'phone'     => '971123456',
            'password'  => Hash::make('12345678'),
            'role_id'   => Role::where('name', 'admin')->value('id'),
        ]);                                              // equivalent a 'Role::where('name', 'admin')->first()->id;'
    }
}
