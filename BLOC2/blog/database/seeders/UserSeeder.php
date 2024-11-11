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
        $adminUser->name = "admin";
        $adminUser->email = "admin@abc.com";
        $adminUser->password = Hash::make('12345678');
        $adminUser->role = 'admin';  //$adminUser->role_id = Role::where('name', 'admin')->value('id');
        $adminUser->save();
    }
}
