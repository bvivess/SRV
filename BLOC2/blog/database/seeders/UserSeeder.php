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
        $user->role_id = Role::where('name', 'admin')->value('id');  // Role::inRandomOrder()->first()->id,
        $user->save();
    }
}
